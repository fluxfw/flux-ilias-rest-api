<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule;

use FluxIliasRestApi\Adapter\Api\ScormLearningModule\LegacyScormLearningModuleType;

final class ScormLearningModuleTypeMapping
{

    public static function mapExternalToInternal(LegacyScormLearningModuleType $type) : LegacyInternalScormLearningModuleType
    {
        return LegacyInternalScormLearningModuleType::from(array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalScormLearningModuleType $type) : LegacyScormLearningModuleType
    {
        return LegacyScormLearningModuleType::from(static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalScormLearningModuleType::SCORM()->value      => LegacyScormLearningModuleType::SCORM_1_2()->value,
            LegacyInternalScormLearningModuleType::SCORM_2004()->value => LegacyScormLearningModuleType::SCORM_2004()->value
        ];
    }
}
