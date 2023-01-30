<?php

namespace FluxIliasRestApi\Service\CronConfig;

use FluxIliasRestApi\Adapter\CronConfig\CustomScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\CronConfig\DefaultScheduleTypeCronConfig;
use FluxIliasRestApi\Adapter\CronConfig\ScheduleTypeCronConfig;

class ScheduleTypeCronConfigMapping
{

    public static function mapExternalToInternal(ScheduleTypeCronConfig $type) : InternalScheduleTypeCronConfig
    {
        return CustomInternalScheduleTypeCronConfig::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalScheduleTypeCronConfig $type) : ScheduleTypeCronConfig
    {
        return CustomScheduleTypeCronConfig::factory(
            static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            DefaultInternalScheduleTypeCronConfig::DAILY->value           => DefaultScheduleTypeCronConfig::DAILY->value,
            DefaultInternalScheduleTypeCronConfig::EVERY_X_DAYS->value    => DefaultScheduleTypeCronConfig::EVERY_X_DAYS->value,
            DefaultInternalScheduleTypeCronConfig::EVERY_X_HOURS->value   => DefaultScheduleTypeCronConfig::EVERY_X_HOURS->value,
            DefaultInternalScheduleTypeCronConfig::EVERY_X_MINUTES->value => DefaultScheduleTypeCronConfig::EVERY_X_MINUTES->value,
            DefaultInternalScheduleTypeCronConfig::MONTHLY->value         => DefaultScheduleTypeCronConfig::MONTHLY->value,
            DefaultInternalScheduleTypeCronConfig::QUARTERLY->value       => DefaultScheduleTypeCronConfig::QUARTERLY->value,
            DefaultInternalScheduleTypeCronConfig::WEEKLY->value          => DefaultScheduleTypeCronConfig::WEEKLY->value,
            DefaultInternalScheduleTypeCronConfig::YEARLY->value          => DefaultScheduleTypeCronConfig::YEARLY->value
        ];
    }
}
