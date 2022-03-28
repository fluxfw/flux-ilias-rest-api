<?php

namespace FluxIliasRestApi\Channel\ObjectLearningProgress;

use FluxIliasRestApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;

class ObjectLearningProgressMapping
{

    public static function mapExternalToInternal(LegacyObjectLearningProgress $learning_progress) : LegacyInternalObjectLearningProgress
    {
        return LegacyInternalObjectLearningProgress::from(array_flip(static::INTERNAL_EXTERNAL())[$learning_progress->value] ?? substr($learning_progress->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalObjectLearningProgress $learning_progress) : LegacyObjectLearningProgress
    {
        return LegacyObjectLearningProgress::from(static::INTERNAL_EXTERNAL()[$learning_progress->value] ?? "_" . $learning_progress->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalObjectLearningProgress::COMPLETED()->value     => LegacyObjectLearningProgress::COMPLETED()->value,
            LegacyInternalObjectLearningProgress::FAILED()->value        => LegacyObjectLearningProgress::FAILED()->value,
            LegacyInternalObjectLearningProgress::IN_PROGRESS()->value   => LegacyObjectLearningProgress::IN_PROGRESS()->value,
            LegacyInternalObjectLearningProgress::NOT_ATTEMPTED()->value => LegacyObjectLearningProgress::NOT_ATTEMPTED()->value
        ];
    }
}
