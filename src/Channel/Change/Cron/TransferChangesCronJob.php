<?php

namespace FluxIliasRestApi\Channel\Change\Cron;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use ilCronJob;
use ilCronJobResult;
use ilPropertyFormGUI;
use ilUriInputGUI;

class TransferChangesCronJob extends ilCronJob
{

    private ChangeService $change;


    public static function new(ChangeService $change) : /*static*/ self
    {
        $cron_job = new static();

        $cron_job->change = $change;

        return $cron_job;
    }


    public function addCustomSettingsToForm(ilPropertyFormGUI $a_form) : void
    {
        $post_url = new ilUriInputGUI("Post url", "post_url");
        $post_url->setRequired(true);
        $post_url->setValue($this->change->getTransferChangesPostUrl());
        $a_form->addItem($post_url);
    }


    public function getDefaultScheduleType() : int
    {
        return static::SCHEDULE_TYPE_IN_MINUTES;
    }


    public function getDefaultScheduleValue() : ?int
    {
        return 5;
    }


    public function getDescription() : string
    {
        return "Transfer new changes after last run to configured url";
    }


    public function getId() : string
    {
        return "flilre_transfer_changes";
    }


    public function getTitle() : string
    {
        return "Transfer changes";
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

        $count = $this->change->transferChanges();

        if ($count !== null) {
            $result->setStatus(ilCronJobResult::STATUS_OK);
            $result->setMessage("Transferred " . $count . " change(s)");
        } else {
            $result->setStatus(ilCronJobResult::STATUS_NO_ACTION);
        }

        return $result;
    }


    public function saveCustomSettings(ilPropertyFormGUI $a_form) : bool
    {
        $this->change->setTransferChangesPostUrl(
            strval($a_form->getInput("post_url"))
        );

        return true;
    }
}
