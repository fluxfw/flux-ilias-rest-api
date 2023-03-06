<?php

namespace FluxIliasRestApi\Service\ScormLearningModule;

use FluxIliasRestApi\Adapter\ScormLearningModule\ScormLearningModuleType;

class ScormLearningModuleTypeMapping
{

    public static function mapExternalToInternal(ScormLearningModuleType $type) : InternalScormLearningModuleType
    {
        return InternalScormLearningModuleType::from(array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1));
    }


    public static function mapInternalToExternal(InternalScormLearningModuleType $type) : ScormLearningModuleType
    {
        return ScormLearningModuleType::from(static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalScormLearningModuleType::SCORM->value      => ScormLearningModuleType::SCORM_1_2->value,
            InternalScormLearningModuleType::SCORM_2004->value => ScormLearningModuleType::SCORM_2004->value
        ];
    }
}
