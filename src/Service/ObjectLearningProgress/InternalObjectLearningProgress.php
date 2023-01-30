<?php

namespace FluxIliasRestApi\Service\ObjectLearningProgress;

enum InternalObjectLearningProgress: int
{

    case NOT_ATTEMPTED = 0;
    case IN_PROGRESS = 1;
    case COMPLETED = 2;
    case FAILED = 3;
}

// ilLPStatus::LP_STATUS_NOT_ATTEMPTED_NUM
// ilLPStatus::LP_STATUS_IN_PROGRESS_NUM
// ilLPStatus::LP_STATUS_COMPLETED_NUM
// ilLPStatus::LP_STATUS_FAILED_NUM
