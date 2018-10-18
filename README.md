# Element CLI plugin for Craft CMS 3.x

Interact with elements via the Craft CLI.

### Entries
#### Available Options
- `section <handle>`
- `entrytype <handle>`
- `status <enabled/disabled>`
- `site <handle>`

#### Available Actions
Get total number of entries:

`./craft element-cli/entries/count`

Delete entries:

`./craft element-cli/entries/delete`

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require venveo/element-cli

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Element CLI.

Brought to you by [Venveo](https://venveo.com)
