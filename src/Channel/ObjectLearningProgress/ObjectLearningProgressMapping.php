<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress;

use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgress;

final class ObjectLearningProgressMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalObjectLearningProgress::COMPLETED     => ObjectLearningProgress::COMPLETED,
            InternalObjectLearningProgress::FAILED        => ObjectLearningProgress::FAILED,
            InternalObjectLearningProgress::IN_PROGRESS   => ObjectLearningProgress::IN_PROGRESS,
            InternalObjectLearningProgress::NOT_ATTEMPTED => ObjectLearningProgress::NOT_ATTEMPTED
        ];


    public static function mapExternalToInternal(?string $learning_progress) : int
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$learning_progress = $learning_progress ?: ObjectLearningProgress::NOT_ATTEMPTED] ?? substr($learning_progress, 1);
    }


    public static function mapInternalToExternal(?int $learning_progress) : string
    {
        return static::INTERNAL_EXTERNAL[$learning_progress = $learning_progress ?: InternalObjectLearningProgress::NOT_ATTEMPTED] ?? "_" . $learning_progress;
    }
}
