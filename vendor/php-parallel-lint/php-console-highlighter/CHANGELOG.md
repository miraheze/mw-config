# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## [Unreleased]

_Nothing yet._


## [1.0.0] - 2022-02-18

### Fixed

- Bug fix: if the highlighted code snippet was at the start of the file, too many lines were retrieved, [#35] from [@jrfnl].
- Bug fix: code snippets highlighted with line numbers had a stray blank line at the end of the snippet, [#35] from [@jrfnl].

### Changed

- BC-Break: The top-level namespace for all classes has changed from `JakubOnderka` to `PHP_Parallel_Lint`. [#28] from [@jrfnl], fixes [#4].
- Support for PHP 5.3 has been restored, [#33] from [@jrfnl].
- PHP 8.0: handle changed tokenization of namespaced names [#19] from [@jrfnl].
- Update [PHP Console Color] dependency to version `^1.0.1` [#17] from [@jrfnl].

### Internal

- Welcome [@jrfnl] as new co-maintainer.
- Improvements to the test suite, [#10], [#15], [#21], [#25], [#34], [#35], [#37], [#38], [#39] from [@peter279k] and [@jrfnl].
- Improvements to the code consistency, [#10], [#20], [#29], [#30], [#] from [@peter279k] and [@jrfnl], fixes [#11].
- Improvements to the CI/QA setup, [#12], [#14], [#16], [#18], [#23], [#24], [#26], [#31], [#36] from [@jrfnl], fixes [#13], [#22].
- Improvements to the changelog, [#27] from [@jrfnl].

[PHP Console Color]: https://github.com/php-parallel-lint/PHP-Console-Color

[#4]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/issues/4
[#10]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/10
[#11]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/issues/11
[#12]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/12
[#13]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/issues/13
[#14]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/14
[#15]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/15
[#16]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/16
[#17]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/17
[#18]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/18
[#19]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/19
[#20]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/20
[#21]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/21
[#22]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/issues/22
[#23]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/23
[#24]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/24
[#25]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/25
[#26]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/26
[#27]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/27
[#28]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/28
[#29]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/29
[#30]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/30
[#31]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/31
[#33]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/33
[#34]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/34
[#35]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/35
[#36]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/36
[#37]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/37
[#38]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/38
[#39]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/pull/39



## [0.5] - 2020-05-13

### Added

- Added changelog from [@reedy].

### Internal

- Cleaned readme - new organization from previous package from [@grogy].
- Composer: marked package as replacing jakub-onderka/php-console-highlighter from [@grogy].
- Composer: updated dependencies to use new php-parallel-lint organisation from [@grogy].
- Travis: test against PHP 7.4 and nightly from [@jrfnl].
- Fixed build script from [@jrfnl].
- Added a .gitattributes file from [@reedy].
- Updated installation command from [@cafferata].


[Unreleased]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/compare/v0.5...v1.0.0
[0.5]: https://github.com/php-parallel-lint/PHP-Console-Highlighter/compare/v0.4...v0.5

[@cafferata]: https://github.com/cafferata
[@grogy]: https://github.com/grogy
[@jrfnl]: https://github.com/jrfnl
[@peter279k]: https://github.com/peter279k
[@reedy]: https://github.com/reedy
