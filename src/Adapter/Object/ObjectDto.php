<?php

namespace FluxIliasRestApi\Adapter\Object;

use JsonSerializable;

class ObjectDto implements JsonSerializable
{

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
    private ?array $ref_ids;
    private ?string $title;
    private ?ObjectType $type;
    private ?int $updated;
    private ?string $url;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?array $ref_ids,
        /*public readonly*/ ?ObjectType $type,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_import_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?bool $in_trash
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
        $this->ref_ids = $ref_ids;
        $this->type = $type;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_import_id = $parent_import_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->icon_url = $icon_url;
        $this->online = $online;
        $this->title = $title;
        $this->description = $description;
        $this->didactic_template_id = $didactic_template_id;
        $this->in_trash = $in_trash;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?array $ref_ids = null,
        ?ObjectType $type = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?bool $online = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $ref_ids,
            $type,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $online,
            $title,
            $description,
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


    public function getRefIds() : ?array
    {
        return $this->ref_ids;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getType() : ?ObjectType
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


    public function isInTrash() : ?bool
    {
        return $this->in_trash;
    }


    public function isOnline() : ?bool
    {
        return $this->online;
    }


    public function jsonSerialize() : array
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return $data;
    }
}
