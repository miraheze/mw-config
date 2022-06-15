<?php
/**
 * MinusX - checks files that shouldn't have an executable bit
 * Copyright (C) 2017 Kunal Mehta <legoktm@member.fsf.org>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @file
 */

namespace MediaWiki\MinusX;

use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCommand extends Command {
	/**
	 * Directories to ignore
	 *
	 * @var string[]
	 */
	protected $defaultIgnoredDirs = [
		'.git',
		'vendor',
		'node_modules',
	];

	/**
	 * Mime types that can always be executable
	 *
	 * @var string[]
	 */
	protected $whitelist = [
		'application/x-executable',
		'application/x-sharedlib',
		'application/x-pie-executable',
		'application/x-mach-binary',
	];

	/**
	 * Ignored files from .minus-x.json
	 *
	 * @var string[]
	 */
	protected $ignoredFiles = [];

	/**
	 * Ignored directories from .minus-x.json
	 *
	 * @var string[]
	 */
	protected $ignoredDirs = [];

	/**
	 * @var InputInterface
	 */
	protected $input;

	/**
	 * @var OutputInterface
	 */
	protected $output;

	/**
	 * How many progress markers we've output so far
	 *
	 * @var int
	 */
	protected $progressCount = 0;

	/**
	 * Initialize command
	 */
	protected function configure() {
		$this->setName( 'check' )
			->setDescription( 'Checks files for executable bits they shouldn\'t have' )
			->addArgument(
				'path',
				InputArgument::REQUIRED,
				'Path to directory to check'
			);
	}

	/**
	 * Output a progress marker
	 *
	 * @param string $marker Either ".", "E" or "S"
	 */
	protected function progress( $marker ) {
		$this->output->write( $marker );
		$this->progressCount++;
		if ( $this->progressCount > 60 ) {
			$this->progressCount = 0;
			$this->output->write( "\n" );
		}
	}

	/**
	 * Do basic setup
	 *
	 * @return int|string If an int, it should be the status code to exit with
	 */
	protected function setup() {
		$this->output->writeln( [
			'MinusX',
			'======',
		] );

		$rawPath = $this->input->getArgument( 'path' );
		$path = realpath( $rawPath );
		if ( !$path ) {
			$this->output->writeln( 'Error: Invalid path specified' );
			return 1;
		}

		return $path;
	}

	/**
	 * Load configuration from .minus-x.json
	 *
	 * @param string $path Root directory that JSON file should be in
	 * @return int|null If an int, status code to exit with
	 */
	protected function loadConfig( $path ) {
		$confPath = $path . '/.minus-x.json';
		if ( !file_exists( $confPath ) ) {
			return;
		}

		$config = json_decode( file_get_contents( $confPath ), true );
		if ( !is_array( $config ) ) {
			$this->output->writeln( 'Error: .minus-x.json is not valid JSON' );
			return 1;
		}

		if ( isset( $config['ignore'] ) ) {
			$this->ignoredFiles = array_map( function ( $a ) use ( $path ) {
				return realpath( $path . '/' . $a );
			}, $config['ignore'] );
		}

		if ( isset( $config['ignoreDirectories'] ) ) {
			$this->ignoredDirs = array_map( function ( $a ) use ( $path ) {
				return realpath( $path . '/' . $a );
			}, $config['ignoreDirectories'] );
		}

		if ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' ) {
			// On Windows, is_executable() always returns true, so whitelist those
			// files
			$this->whitelist[] = 'application/x-dosexec';
		}
	}

	/**
	 * Run!
	 *
	 * @param InputInterface $input Input
	 * @param OutputInterface $output Output
	 *
	 * @return int Status code
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {
		$this->output = $output;
		$this->input = $input;
		$path = $this->setup();
		if ( is_int( $path ) ) {
			return $path;
		}
		$err = $this->loadConfig( $path );
		if ( is_int( $err ) ) {
			return $err;
		}

		$output->writeln( "Processing $path..." );
		$bad = $this->checkPath( $path );
		$output->write( "\n" );
		if ( $bad ) {
			foreach ( $bad as $file ) {
				$output->writeln( "Error: {$file->getPathname()} should not be executable" );
			}
			return 1;
		} else {
			$output->writeln( 'All good!' );
			return 0;
		}
	}

	/**
	 * Filter out ignored directories, split into a separate
	 * function for easier readability. Used by
	 * RecursiveCallbackFilterIterator
	 *
	 * @param SplFileInfo $current File/directory to check
	 * @return bool
	 */
	public function filterDirs( SplFileInfo $current ) {
		if ( $current->isDir() ) {
			if ( in_array( $current->getFilename(), $this->defaultIgnoredDirs ) ) {
				// Default ignored directories can be anywhere in the directory structure
				return false;
			} elseif ( in_array( $current->getRealPath(), $this->ignoredDirs ) ) {
				// Ignored dirs are relative to root, and stored as absolute paths
				return false;
			}
		}

		return true;
	}

	/**
	 * Recursively search a directory and check it
	 *
	 * @param string $path Directory
	 * @return SplFileInfo[]
	 */
	protected function checkPath( $path ) {
		$iterator = new RecursiveIteratorIterator(
			new RecursiveCallbackFilterIterator(
				new RecursiveDirectoryIterator( $path ),
				[ $this, 'filterDirs' ]
			)
		);
		$bad = [];
		/** @var SplFileInfo $file */
		foreach ( $iterator as $file ) {
			// Skip directories
			if ( !$file->isFile() ) {
				continue;
			}

			// Skip whitelisted files
			if ( in_array( $file->getPathname(), $this->ignoredFiles ) ) {
				$this->progress( 'S' );
				continue;
			}

			if ( !$file->isExecutable() ) {
				$this->progress( '.' );
				continue;
			}

			if ( !$this->checkFile( $file ) ) {
				$this->progress( 'E' );
				$bad[] = $file;
			} else {
				$this->progress( '.' );
			}
		}

		return $bad;
	}

	/**
	 * @param SplFileInfo $file File to check
	 * @return bool If true, its OK to be executable
	 */
	protected function checkFile( SplFileInfo $file ) {
		$mime = mime_content_type( $file->getPathname() );
		if ( in_array( $mime, $this->whitelist ) ) {
			// Whitelisted
			return true;
		}

		list( $type, $subtype ) = explode( '/', $mime, 2 );
		// If the mime type isn't application/ or text/ don't check for a shebang
		if ( !in_array( $type, [ 'application', 'text' ] ) ) {
			return false;
		}

		// Check for a shebang in the first 5 bytes
		$start = $file->openFile()->fread( 5 );
		return strpos( $start, '#!' ) === 0;
	}
}
