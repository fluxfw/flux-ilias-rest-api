<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress;

use FluxLegacyEnum\Adapter\Backed\LegacyIntBackedEnum;

// ilLPStatus::LP_STATUS_NOT_ATTEMPTED_NUM
// ilLPStatus::LP_STATUS_IN_PROGRESS_NUM
// ilLPStatus::LP_STATUS_COMPLETED_NUM
// ilLPStatus::LP_STATUS_FAILED_NUM

/**
 * @method static static NOT_ATTEMPTED() 0
 * @method static static IN_PROGRESS() 1
 * @method static static COMPLETED() 2
 * @method static static FAILED() 3
 */
final class LegacyInternalObjectLearningProgress extends LegacyIntBackedEnum
{

}
