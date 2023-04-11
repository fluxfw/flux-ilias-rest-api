<?php

namespace FluxIliasRestApi\Adapter\CronConfig;

enum   DefaultScheduleTypeCronConfig: string implements ScheduleTypeCronConfig
{

    case DAILY = "daily";
    case EVERY_X_DAYS = "every-x-days";
    case EVERY_X_HOURS = "every-x-hours";
    case EVERY_X_MINUTES = "every-x-minutes";
    case MONTHLY = "monthly";
    case QUARTERLY = "quarterly";
    case WEEKLY = "weekly";
    case YEARLY = "yearly";
}
