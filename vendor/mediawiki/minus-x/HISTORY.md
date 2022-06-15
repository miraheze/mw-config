# MinusX release history #

## 1.1.1 / 2021-01-05 ##
* Restore support of symfony/console ^3.3.5 and ^4 (Kunal Mehta)

## 1.1.0 / 2020-03-17 ##
* Add application/x-pie-executable and x-mach-binary to whitelist (Umherirrender)

## 1.0.0 / 2020-01-20 ##
* Mention always ignored directories in the readme (mainframe98)
* Permit symfony/console version 5 (Sam Wilson)
* Drop support for earlier versions of symfony/console (Kunal Mehta)
* Revert "Don't use SplFileObject::fread() for PHP < 5.5.11 support" (Kunal Mehta)

## 0.3.2 / 2018-10-02 ##
* Support using symfony/console ^4 (Kunal Mehta)
* Use SPDX 3.0 license identifier (Umherirrender)

## 0.3.1 / 2018-02-17 ##
* Add .gitattributes with export-ignore (Umherirrender)

## 0.3.0 / 2018-01-10 ##
* Loosen symfony/console dependency (Kunal Mehta)
* Support ignoring entire directories (Kunal Mehta)

## 0.2.1 / 2017-12-03 ##
* Percent-encode URLs in `README.md` to work around bad parsers. (MZMcBride)
* Use env instead of /usr/bin/php directly (Sam Wilson)

## 0.2.0 / 2017-10-30 ##
* Don't use SplFileObject::fread() for PHP < 5.5.11 support (Kunal Mehta)
* Drop .php extension from minus-x command (Kunal Mehta)
* Whitelist `application/x-dosexec` when run on Windows (Kunal Mehta)

## 0.1.0 / 2017-09-12 ##

* Initial release (Kunal Mehta)
