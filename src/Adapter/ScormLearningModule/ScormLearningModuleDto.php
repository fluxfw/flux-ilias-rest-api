<?php

namespace FluxIliasRestApi\Adapter\ScormLearningModule;

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
    private ?bool $in_trash;
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


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_import_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?LegacyScormLearningModuleType $type,
        /*public readonly*/ ?int $version,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?bool $authoring_mode,
        /*public readonly*/ ?bool $sequencing_expert_mode,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?bool $in_trash
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_import_id = $parent_import_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->version = $version;
        $this->online = $online;
        $this->authoring_mode = $authoring_mode;
        $this->sequencing_expert_mode = $sequencing_expert_mode;
        $this->didactic_template_id = $didactic_template_id;
        $this->in_trash = $in_trash;
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
        ?LegacyScormLearningModuleType $type = null,
        ?int $version = null,
        ?bool $online = null,
        ?bool $authoring_mode = null,
        ?bool $sequencing_expert_mode = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null
    ) : /*static*/ self
    {
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


    public function isInTrash() : ?bool
    {
        return $this->in_trash;
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
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return $data;
    }
}
