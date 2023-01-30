<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\CronConfig\Port\CronConfigService;

class SetPurgeChangesScheduleCommand
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly CronConfigService $cron_config_service
    ) {

    }


    public static function new(
        ChangeService $change_service,
        CronConfigService $cron_config_service
    ) : static {
        return new static(
            $change_service,
            $cron_config_service
        );
    }


    public function setPurgeChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        $this->cron_config_service->setCronJobSchedule(
            $this->change_service->getPurgeChangesCronJob(),
            $type,
            $interval
        );
    }
}
