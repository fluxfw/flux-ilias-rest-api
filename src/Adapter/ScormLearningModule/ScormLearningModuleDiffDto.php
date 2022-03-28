<?php

namespace FluxIliasRestApi\Adapter\ScormLearningModule;

class ScormLearningModuleDiffDto
{

    private ?bool $authoring_mode;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $import_id;
    private ?bool $online;
    private ?bool $sequencing_expert_mode;
    private ?string $title;
    private ?LegacyScormLearningModuleType $type;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?LegacyScormLearningModuleType $type,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?bool $authoring_mode,
        /*public readonly*/ ?bool $sequencing_expert_mode,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->online = $online;
        $this->authoring_mode = $authoring_mode;
        $this->sequencing_expert_mode = $sequencing_expert_mode;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?LegacyScormLearningModuleType $type = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
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


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            ($type = $data->type ?? null) !== null ? LegacyScormLearningModuleType::from($type) : null,
            $data->online ?? null,
            $data->authoring_mode ?? null,
            $data->sequencing_expert_mode ?? null,
            $data->didactic_template_id ?? null
        );
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getType() : ?LegacyScormLearningModuleType
    {
        return $this->type;
    }


    public function isAuthoringMode() : ?bool
    {
        return $this->authoring_mode;
    }


    public function isOnline() : ?bool
    {
        return $this->online;
    }


    public function isSequencingExpertMode() : ?bool
    {
        return $this->sequencing_expert_mode;
    }
}
