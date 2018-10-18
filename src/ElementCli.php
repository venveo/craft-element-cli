<?php
/**
 * Element CLI plugin for Craft CMS 3.x
 *
 * Interact with elements via the Craft CLI
 *
 * @link      https://venveo.com
 * @copyright Copyright (c) 2018 Venveo
 */

namespace venveo\elementcli;

use Craft;
use craft\base\Plugin;
use craft\console\Application as ConsoleApplication;

/**
 * Class ElementCli
 *
 * @author    Venveo
 * @package   ElementCli
 * @since     1.0.0
 *
 */
class ElementCli extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ElementCli
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (Craft::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'venveo\elementcli\console\controllers';
        }

        Craft::info(
            Craft::t(
                'element-cli',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
