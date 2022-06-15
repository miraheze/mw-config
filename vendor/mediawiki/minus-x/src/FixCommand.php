<?php
/**
 * MinusX - fixes files that shouldn't have an executable bit
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

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixCommand extends CheckCommand {

	/**
	 * Initialize command
	 */
	protected function configure() {
		$this->setName( 'fix' )
			->setDescription( 'Removes executable bit from files that shouldn\'t have it' )
			->addArgument(
				'path',
				InputArgument::REQUIRED,
				'Path to directory to fix'
			);
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

		$output->writeln( "Fixing $path..." );
		$bad = $this->checkPath( $path );
		$output->write( "\n" );
		if ( $bad ) {
			foreach ( $bad as $file ) {
				$this->minusX( $file->getPathname() );
				$output->writeln( "chmod a-x {$file->getPathname()}" );
			}
		} else {
			$output->writeln( 'All good!' );
		}

		return 0;
	}

	/**
	 * Remove executable bit from file
	 *
	 * @param string $filepath File
	 */
	protected function minusX( $filepath ) {
		chmod( $filepath, fileperms( $filepath ) & ~0111 );
	}

}
