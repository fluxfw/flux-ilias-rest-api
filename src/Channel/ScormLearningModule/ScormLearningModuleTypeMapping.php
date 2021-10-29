<?php

namespace FluxIliasRestApi\Channel\ScormLearningModule;

use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleType;

final class ScormLearningModuleTypeMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalScormLearningModuleType::SCORM      => ScormLearningModuleType::SCORM_1_2,
            InternalScormLearningModuleType::SCORM_2004 => ScormLearningModuleType::SCORM_2004
        ];


    public static function mapExternalToInternal(?string $scorm_learning_module_type) : ?string
    {
        return ($scorm_learning_module_type = $scorm_learning_module_type ?: null) !== null ? array_flip(static::INTERNAL_EXTERNAL)[$scorm_learning_module_type] ??
            substr($scorm_learning_module_type, 1) : null;
    }


    public static function mapInternalToExternal(?string $scorm_learning_module_type) : ?string
    {
        return ($scorm_learning_module_type = $scorm_learning_module_type ?: null) !== null ? static::INTERNAL_EXTERNAL[$scorm_learning_module_type] ?? "_" . $scorm_learning_module_type : null;
    }
}
