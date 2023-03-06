<?php

namespace FluxIliasRestApi\Adapter\ObjectLearningProgress;

enum ObjectLearningProgress: string
{

    case COMPLETED = "completed";
    case FAILED = "failed";
    case IN_PROGRESS = "in_progress";
    case NOT_ATTEMPTED = "not_attempted";
}
