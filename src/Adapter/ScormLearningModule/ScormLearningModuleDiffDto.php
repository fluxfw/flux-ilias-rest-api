<?php

namespace FluxIliasRestApi\Adapter\ScormLearningModule;

class ScormLearningModuleDiffDto
{

    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?ScormLearningModuleType $type,
        public readonly ?bool $online,
        public readonly ?bool $authoring_mode,
        public readonly ?bool $sequencing_expert_mode,
        public readonly ?int $didactic_template_id
    ) {

    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?ScormLearningModuleType $type = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description,
            $type,
            $online,
            $authoring_mode,
            $sequencing_expert_mode,
            $didactic_template_id
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            ($type = $diff->type ?? null) !== null ? ScormLearningModuleType::from($type) : null,
            $diff->online ?? null,
            $diff->authoring_mode ?? null,
            $diff->sequencing_expert_mode ?? null,
            $diff->didactic_template_id ?? null
        );
    }
}
