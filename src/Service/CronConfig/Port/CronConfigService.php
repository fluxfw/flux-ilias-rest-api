<?php

namespace FluxIliasRestApi\Service\CronConfig\Port;

use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use FluxIliasRestApi\Service\CronConfig\Command\GetCronJobScheduleCommand;
use FluxIliasRestApi\Service\CronConfig\Command\IsCronJobEnabledCommand;
use FluxIliasRestApi\Service\CronConfig\Command\SetCronJobEnabledCommand;
use FluxIliasRestApi\Service\CronConfig\Command\SetCronJobScheduleCommand;
use ilCronJob;
use ilObjUser;

class CronConfigService
{

    private function __construct(
        private readonly IliasCronWrapper $ilias_cron_wrapper,
        private readonly ilObjUser $ilias_user
    ) {

    }


    public static function new(
        IliasCronWrapper $ilias_cron_wrapper,
        ilObjUser $ilias_user
    ) : static {
        return new static(
            $ilias_cron_wrapper,
            $ilias_user
        );
    }


    public function getCronJobSchedule(ilCronJob $cron_job) : object
    {
        return GetCronJobScheduleCommand::new(
            $this->ilias_cron_wrapper
        )
            ->getCronJobSchedule(
                $cron_job
            );
    }


    public function isCronJobEnabled(ilCronJob $cron_job) : bool
    {
        return IsCronJobEnabledCommand::new(
            $this->ilias_cron_wrapper
        )
            ->isCronJobEnabled(
                $cron_job
            );
    }


    public function setCronJobEnabled(ilCronJob $cron_job, bool $enabled) : void
    {
        SetCronJobEnabledCommand::new(
            $this->ilias_cron_wrapper,
            $this->ilias_user
        )
            ->setCronJobEnabled(
                $cron_job,
                $enabled
            );
    }


    public function setCronJobSchedule(ilCronJob $cron_job, ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetCronJobScheduleCommand::new(
            $this->ilias_cron_wrapper
        )
            ->setCronJobSchedule(
                $cron_job,
                $type,
                $interval
            );
    }
}
