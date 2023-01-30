<?php

namespace FluxIliasRestApi\Service\ObjectLearningProgress;

use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;

class ObjectLearningProgressMapping
{

    public static function mapExternalToInternal(ObjectLearningProgress $learning_progress) : InternalObjectLearningProgress
    {
        return InternalObjectLearningProgress::from(array_flip(static::INTERNAL_EXTERNAL())[$learning_progress->value] ?? substr($learning_progress->value, 1));
    }


    public static function mapInternalToExternal(InternalObjectLearningProgress $learning_progress) : ObjectLearningProgress
    {
        return ObjectLearningProgress::from(static::INTERNAL_EXTERNAL()[$learning_progress->value] ?? "_" . $learning_progress->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalObjectLearningProgress::COMPLETED->value     => ObjectLearningProgress::COMPLETED->value,
            InternalObjectLearningProgress::FAILED->value        => ObjectLearningProgress::FAILED->value,
            InternalObjectLearningProgress::IN_PROGRESS->value   => ObjectLearningProgress::IN_PROGRESS->value,
            InternalObjectLearningProgress::NOT_ATTEMPTED->value => ObjectLearningProgress::NOT_ATTEMPTED->value
        ];
    }
}
