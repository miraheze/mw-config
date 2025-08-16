<?php

namespace Miraheze\Config\Tests\Mock;

class MirahezeFunctions {

	public string $dbname = '';
	public string $server = '';
	public string $sitename = '';
	public string $version = '';

	public function getSettingValue(): array {
		return [];
	}

	public function isAllOfExtensionsActive(): true {
		return true;
	}

	public function isAnyOfExtensionsActive(): true {
		return true;
	}

	public function isExtensionActive(): true {
		return true;
	}
}
