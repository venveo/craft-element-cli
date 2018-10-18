<?php
/**
 * Element CLI plugin for Craft CMS 3.x
 *
 * Interact with elements via the Craft CLI
 *
 * @link      https://venveo.com
 * @copyright Copyright (c) 2018 Venveo
 */

namespace venveo\elementcli\console\controllers;

use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Elements Command
 *
 * @author    Venveo
 * @package   ElementCli
 * @since     1.0.0
 */
class EntriesController extends Controller
{
    // Public Methods
    // =========================================================================
    public $section;
    public $entrytype;
    public $site;
    public $status;

    /** @var EntryQuery */
    private $query;

    public function options($actionId)
    {
        return ['section', 'entrytype', 'site', 'status'];
    }


    public function beforeAction($action)
    {
        $this->query = new EntryQuery(Entry::class);
        if ($this->section !== null) {
            $this->query->section($this->section);
        }

        if ($this->entrytype !== null) {
            $this->query->type($this->entrytype);
        }

        if ($this->status !== null) {
           $this->query->status($this->status);
        }

        if ($this->site !== null) {
            $this->query->site($this->site);
        }


        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Handle element-cli/elements/count console commands
     *
     * @return mixed
     */
    public function actionCount()
    {
        echo $this->query->count()."\n";

        return ExitCode::OK;
    }

    /**
     * Permanently deletes all entries meeting the criteria defined
     *
     * @throws \Throwable
     */
    public function actionDelete()
    {
        $numberOfItems = $this->query->count();
        $verify = $this->prompt('Are you sure you would like to delete '.$numberOfItems.' entries? (Y/n)');
        if ($verify === 'Y') {
            echo 'Deleting...';
            Console::startProgress(0, $numberOfItems);
            /** @var Entry $entry */
            foreach ($this->query->each() as $i => $entry) {
                try {
                    \Craft::$app->elements->deleteElement($entry);
                } catch (\Exception $e) {
                    echo 'Failed to delete '.$entry->id.': '.$e->getMessage();
                }
                Console::updateProgress(++$i, $numberOfItems);
            }
            Console::endProgress();
        }
    }
}