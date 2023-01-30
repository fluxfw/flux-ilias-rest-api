<?php

namespace FluxIliasRestApi\Service\CronConfig\Command;

use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use FluxIliasRestApi\Service\CronConfig\CustomInternalScheduleTypeCronConfig;
use FluxIliasRestApi\Service\CronConfig\ScheduleTypeCronConfigMapping;
use ilCronJob;

class GetCronJobScheduleCommand
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


    public function getCronJobSchedule(ilCronJob $cron_job) : object
    {
        $data = $this->ilias_cron_wrapper->getCronJobData($cron_job->getId());

        if (!empty($data)) {
            $data = current($data);
        } else {
            $data = [
                "schedule_type"  => $cron_job->getDefaultScheduleType(),
                "schedule_value" => $cron_job->getDefaultScheduleValue()
            ];
        }

        $internal_type = CustomInternalScheduleTypeCronConfig::factory(
            $data["schedule_type"]
        );

        if (in_array($internal_type->value, $cron_job->getScheduleTypesWithValues())) {
            $interval = intval($data["schedule_value"]);
        } else {
            $interval = null;
        }

        return (object) [
            "type"           => ScheduleTypeCronConfigMapping::mapInternalToExternal($internal_type),
            "interval"       => $interval,
            "types"          => array_map(fn(int $type) : ScheduleTypeCronConfig => ScheduleTypeCronConfigMapping::mapInternalToExternal(CustomInternalScheduleTypeCronConfig::factory(
                $type
            )),
                $cron_job->getValidScheduleTypes()),
            "interval_types" => array_map(fn(int $type) : ScheduleTypeCronConfig => ScheduleTypeCronConfigMapping::mapInternalToExternal(CustomInternalScheduleTypeCronConfig::factory(
                $type
            )),
                $cron_job->getScheduleTypesWithValues())

        ];
    }
}
