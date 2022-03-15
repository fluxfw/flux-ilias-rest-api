<?php

namespace FluxIliasRestApi\Channel\Change\Cron;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use ilCronJob;
use ilCronJobResult;
use ilNumberInputGUI;
use ilPropertyFormGUI;

class PurgeChangesCronJob extends ilCronJob
{

    private ChangeService $change_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->change_service = $change_service;
    }


    public static function new(
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $change_service
        );
    }


    public function addCustomSettingsToForm(ilPropertyFormGUI $a_form) : void
    {
        $keep_changes_inside_days = new ilNumberInputGUI("Keep changes inside", "keep_changes_inside_days");
        $keep_changes_inside_days->setSuffix("days");
        $keep_changes_inside_days->setRequired(true);
        $keep_changes_inside_days->setMinValue(0);
        $keep_changes_inside_days->setValue($this->change_service->getKeepChangesInsideDays());
        $a_form->addItem($keep_changes_inside_days);
    }


    public function getDefaultScheduleType() : int
    {
        return static::SCHEDULE_TYPE_DAILY;
    }


    public function getDefaultScheduleValue() : ?int
    {
        return null;
    }


    public function getDescription() : string
    {
        return "Automatically purge changes and only keep changes inside configured days";
    }


    public function getId() : string
    {
        return "flilre_purge_changes";
    }


    public function getTitle() : string
    {
        return "Purge changes";
    }


    public function hasAutoActivation() : bool
    {
        return false;
    }


    public function hasCustomSettings() : bool
    {
        return true;
    }


    public function hasFlexibleSchedule() : bool
    {
        return true;
    }


    public function run() : ilCronJobResult
    {
        $result = new ilCronJobResult();

        $count = $this->change_service->purgeChanges();

        if ($count !== null) {
            $result->setStatus(ilCronJobResult::STATUS_OK);
            $result->setMessage("Purged " . $count . " change(s)");
        } else {
            $result->setStatus(ilCronJobResult::STATUS_NO_ACTION);
        }

        return $result;
    }


    public function saveCustomSettings(ilPropertyFormGUI $a_form) : bool
    {
        $this->change_service->setKeepChangesInsideDays(
            max(0, intval($a_form->getInput("keep_changes_inside_days")))
        );

        return true;
    }
}
