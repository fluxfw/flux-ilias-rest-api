<?php

namespace FluxIliasRestApi\Service\CronConfig;

enum DefaultInternalScheduleTypeCronConfig: int implements InternalScheduleTypeCronConfig
{

    case DAILY = 1;
    case EVERY_X_DAYS = 4;
    case EVERY_X_HOURS = 3;
    case EVERY_X_MINUTES = 2;
    case MONTHLY = 6;
    case QUARTERLY = 7;
    case WEEKLY = 5;
    case YEARLY = 8;
}
