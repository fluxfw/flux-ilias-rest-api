<?php

namespace FluxIliasRestApi\Adapter\CronConfig;

enum   DefaultScheduleTypeCronConfig: string implements ScheduleTypeCronConfig
{

    case DAILY = "daily";
    case EVERY_X_DAYS = "every_x_days";
    case EVERY_X_HOURS = "every_x_hours";
    case EVERY_X_MINUTES = "every_x_minutes";
    case MONTHLY = "monthly";
    case QUARTERLY = "quarterly";
    case WEEKLY = "weekly";
    case YEARLY = "yearly";
}
