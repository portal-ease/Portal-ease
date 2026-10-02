# Changelog

All notable changes to PortalEase will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Added

* Added a manager and employee role to portal ease
* Added Redis to optimize queries and caching in portal ease
* Added portal features to chose what features you want in your portal
* Added Documentation page to make it more clear how portal ease works
* Added pest tests for functionalities to customers like the controller and model
* Added changelog.md file for clearer changes and to follow more into open source

### Changed

* Refactored the portal controller to make optimizations

### Fixed

*

### Removed

*

---

## Versioning

PortalEase follows [Semantic Versioning](https://semver.org/).

Given a version number `MAJOR.MINOR.PATCH`:

* `MAJOR` — incompatible or major changes.
* `MINOR` — new backwards-compatible functionality.
* `PATCH` — backwards-compatible bug fixes.

### Version examples

* `0.3.2` — bug fixes and smaller improvements.
* `0.4.0` — new backwards-compatible functionality.
* `1.0.0` — first stable release.

---

## Release process

For each PortalEase release:

1. Add all relevant changes to `Unreleased`.
2. Review and group the changes under `Added`, `Changed`, `Fixed`, `Removed`, `Deprecated`, or `Security`.
3. Move the changes from `Unreleased` into the new version.
4. Add the release date.
5. Create a Git tag matching the version.
6. Create a GitHub Release for the tag.
7. Create a new empty `Unreleased` section.

GitHub Releases are based on Git tags, so each PortalEase release should correspond to a specific tag.

[Unreleased]: https://github.com/portal-ease/Portal-ease/compare/v0.3.2...HEAD
[0.3.2]: https://github.com/portal-ease/Portal-ease/releases/tag/v0.3.2
[0.2.1]: https://github.com/portal-ease/Portal-ease/releases/tag/v0.2.1
[0.1.0]: https://github.com/portal-ease/Portal-ease/releases/tag/v0.1.0
