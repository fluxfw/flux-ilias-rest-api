<?php

namespace FluxIliasRestApi\Adapter\Cron\Change;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\CronConfig\DefaultInternalScheduleTypeCronConfig;
use ilCronJob;
use ilCronJobResult;

class PurgeChangesCronJob extends ilCronJob
{

    public const ID = "flilre_purge_changes";


    private function __construct(
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ChangeService $change_service
    ) : static {
        return new static(
            $change_service
        );
    }


    public function getDefaultScheduleType() : int
    {
        return DefaultInternalScheduleTypeCronConfig::DAILY->value;
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
        return static::ID;
    }


    public function getTitle() : string
    {
        return "Purge changes";
    }


    public function hasAutoActivation() : bool
    {
        return false;
    }


    public function hasFlexibleSchedule() : bool
    {
        return true;
    }


    public function run() : ilCronJobResult
    {
        $result = new ilCronJobResult();

        $count = $this->change_service->purgeChanges();

        $result->setStatus(ilCronJobResult::STATUS_OK);
        $result->setMessage("Purged " . $count . " change(s)");

        return $result;
    }
}
