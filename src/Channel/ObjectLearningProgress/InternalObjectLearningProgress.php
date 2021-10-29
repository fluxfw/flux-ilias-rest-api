<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress;

use ilLPStatus;

final class InternalObjectLearningProgress
{

    const COMPLETED = ilLPStatus::LP_STATUS_COMPLETED_NUM;
    const FAILED = ilLPStatus::LP_STATUS_FAILED_NUM;
    const IN_PROGRESS = ilLPStatus::LP_STATUS_IN_PROGRESS_NUM;
    const NOT_ATTEMPTED = ilLPStatus::LP_STATUS_NOT_ATTEMPTED_NUM;
}
