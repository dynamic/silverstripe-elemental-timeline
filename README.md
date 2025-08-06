# SilverStripe Elemental Timeline

A timeline block useful for company history.

![CI](https://github.com/dynamic/silverstripe-elemental-timeline/workflows/CI/badge.svg)
[![codecov](https://codecov.io/gh/dynamic/silverstripe-elemental-timeline/branch/master/graph/badge.svg)](https://codecov.io/gh/dynamic/silverstripe-elemental-timeline)

[![Latest Stable Version](https://poser.pugx.org/dynamic/silverstripe-elemental-timeline/v/stable)](https://packagist.org/packages/dynamic/silverstripe-elemental-timeline)
[![Total Downloads](https://poser.pugx.org/dynamic/silverstripe-elemental-timeline/downloads)](https://packagist.org/packages/dynamic/silverstripe-elemental-timeline)
[![Latest Unstable Version](https://poser.pugx.org/dynamic/silverstripe-elemental-timeline/v/unstable)](https://packagist.org/packages/dynamic/silverstripe-elemental-timeline)
[![License](https://poser.pugx.org/dynamic/silverstripe-elemental-timeline/license)](https://packagist.org/packages/dynamic/silverstripe-elemental-timeline)


## Requirements

* dnadesign/silverstripe-elemental: ^5.0
* dynamic/silverstripe-elemental-baseobject: ^5.0
* silverstripe/recipe-cms: ^5.0

## Installation

```
composer require dynamic/silverstripe-elemental-timeline
```

## License
See [License](license.md)

## Upgrading from version 1

Elemental Timeline drops `sheadawson/silverstripe-linkable` usage in favor of `gorriecoe/silverstripe-linkfield`. To avoid data loss, install the `dynamic/silverstripe-link-migrator` module as follows:

```markdown
composer require dynamic/silverstripe-link-migrator
```

Then, run the task "Linkable to SilverStripe Link Migration" via `/dev/tasks`, or cli via:
```markdown
vendor/bin/sake dev/tasks/LinkableMigrationTask
```

This will populate all of the new Link fields with data from the old class.

## Usage

A block that allows you to create a timeline with key milestones.

### Template Notes

The default templates are based off [Bootstrap 5](https://getbootstrap.com/) classes/styling for consistency with the SilverStripe Essentials theme ecosystem.

## Getting more elements

See [Elemental modules by Dynamic](https://github.com/orgs/dynamic/repositories?q=elemental&type=all&language=&sort=)

## Configuration

See [SilverStripe Elemental Configuration](https://github.com/dnadesign/silverstripe-elemental#configuration)

## Maintainers
 *  [Dynamic](https://www.dynamicagency.com) (<dev@dynamicagency.com>)

## Bugtracker
Bugs are tracked in the issues section of this repository. Before submitting an issue please read over
existing issues to ensure yours is unique.

If the issue does look like a new bug:

 - Create a new issue
 - Describe the steps required to reproduce your issue, and the expected outcome. Unit tests, screenshots
 and screencasts can help here.
 - Describe your environment as detailed as possible: SilverStripe version, Browser, PHP version,
 Operating System, any installed SilverStripe modules.

Please report security issues to the module maintainers directly. Please don't file security issues in the bugtracker.

## Development and contribution
If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.
