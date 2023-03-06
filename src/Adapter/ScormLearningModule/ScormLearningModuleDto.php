<?php

namespace FluxIliasRestApi\Adapter\ScormLearningModule;

use JsonSerializable;

class ScormLearningModuleDto implements JsonSerializable
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $icon_url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?ScormLearningModuleType $type,
        public readonly ?int $version,
        public readonly ?bool $online,
        public readonly ?bool $authoring_mode,
        public readonly ?bool $sequencing_expert_mode,
        public readonly ?int $didactic_template_id,
        public readonly ?bool $in_trash
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?ScormLearningModuleType $type = null,
        ?int $version = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $title,
            $description,
            $type,
            $version,
            $online,
            $authoring_mode,
            $sequencing_expert_mode,
            $didactic_template_id,
            $in_trash
        );
    }


    public static function newFromObject(
        object $scorm_learning_module
    ) : static {
        return static::new(
            $scorm_learning_module->id ?? null,
            $scorm_learning_module->import_id ?? null,
            $scorm_learning_module->ref_id ?? null,
            $scorm_learning_module->created ?? null,
            $scorm_learning_module->updated ?? null,
            $scorm_learning_module->parent_id ?? null,
            $scorm_learning_module->parent_import_id ?? null,
            $scorm_learning_module->parent_ref_id ?? null,
            $scorm_learning_module->url ?? null,
            $scorm_learning_module->icon_url ?? null,
            $scorm_learning_module->title ?? null,
            $scorm_learning_module->description ?? null,
            ($type = $scorm_learning_module->type ?? null) !== null ? ScormLearningModuleType::from($type) : null,
            $scorm_learning_module->version ?? null,
            $scorm_learning_module->online ?? null,
            $scorm_learning_module->authoring_mode ?? null,
            $scorm_learning_module->sequencing_expert_mode ?? null,
            $scorm_learning_module->didactic_template_id ?? null,
            $scorm_learning_module->in_trash ?? null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
