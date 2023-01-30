<?php

namespace FluxIliasRestApi\Service\CronConfig\Command;

use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use FluxIliasRestApi\Service\CronConfig\ScheduleTypeCronConfigMapping;
use ilCronJob;

class SetCronJobScheduleCommand
{

    private function __construct(
        private readonly IliasCronWrapper $ilias_cron_wrapper
    ) {

    }


    public static function new(
        IliasCronWrapper $ilias_cron_wrapper
    ) : static {
        return new static(
            $ilias_cron_wrapper
        );
    }


    public function setCronJobSchedule(ilCronJob $cron_job, ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        $internal_type = ScheduleTypeCronConfigMapping::mapExternalToInternal($type);

        if (in_array($internal_type->value, $cron_job->getValidScheduleTypes())) {
            if (in_array($internal_type->value, $cron_job->getScheduleTypesWithValues())) {
                $interval = max(0, $interval);
            } else {
                $interval = null;
            }

            $this->ilias_cron_wrapper->updateJobSchedule($cron_job, $internal_type->value, $interval);
        }
    }
}
