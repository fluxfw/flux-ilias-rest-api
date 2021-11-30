<?php

namespace FluxIliasRestApi\Adapter\Api\ScormLearningModule;

use JsonSerializable;

class ScormLearningModuleDto implements JsonSerializable
{

    private ?bool $authoring_mode;
    private ?int $created;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $icon_url;
    private ?int $id;
    private ?string $import_id;
    private ?bool $online;
    private ?int $parent_id;
    private ?string $parent_import_id;
    private ?int $parent_ref_id;
    private ?int $ref_id;
    private ?bool $sequencing_expert_mode;
    private ?string $title;
    private ?LegacyScormLearningModuleType $type;
    private ?int $updated;
    private ?string $url;
    private ?int $version;


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
        ?LegacyScormLearningModuleType $type = null,
        ?int $version = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->ref_id = $ref_id;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->parent_id = $parent_id;
        $dto->parent_import_id = $parent_import_id;
        $dto->parent_ref_id = $parent_ref_id;
        $dto->url = $url;
        $dto->icon_url = $icon_url;
        $dto->title = $title;
        $dto->description = $description;
        $dto->type = $type;
        $dto->version = $version;
        $dto->online = $online;
        $dto->authoring_mode = $authoring_mode;
        $dto->sequencing_expert_mode = $sequencing_expert_mode;
        $dto->didactic_template_id = $didactic_template_id;

        return $dto;
    }


    public function getCreated() : ?int
    {
        return $this->created;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getIconUrl() : ?string
    {
        return $this->icon_url;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getParentId() : ?int
    {
        return $this->parent_id;
    }


    public function getParentImportId() : ?string
    {
        return $this->parent_import_id;
    }


    public function getParentRefId() : ?int
    {
        return $this->parent_ref_id;
    }


    public function getRefId() : ?int
    {
        return $this->ref_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getType() : ?LegacyScormLearningModuleType
    {
        return $this->type;
    }


    public function getUpdated() : ?int
    {
        return $this->updated;
    }


    public function getUrl() : ?string
    {
        return $this->url;
    }


    public function getVersion() : ?int
    {
        return $this->version;
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


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
