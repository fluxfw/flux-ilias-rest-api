<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnit;

use JsonSerializable;

class OrganisationalUnitDto implements JsonSerializable
{

    private ?int $created;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $external_id;
    private ?int $id;
    private ?string $parent_external_id;
    private ?int $parent_id;
    private ?int $parent_ref_id;
    private ?int $ref_id;
    private ?string $title;
    private ?int $type_id;
    private ?int $updated;
    private ?string $url;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_external_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $type_id,
        /*public readonly*/ ?string $external_id,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->id = $id;
        $this->ref_id = $ref_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_external_id = $parent_external_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->type_id = $type_id;
        $this->external_id = $external_id;
        $this->didactic_template_id = $didactic_template_id;
    }


    public static function new(
        ?int $id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_external_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_external_id,
            $parent_ref_id,
            $url,
            $title,
            $description,
            $type_id,
            $external_id,
            $didactic_template_id
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


    public function getExternalId() : ?string
    {
        return $this->external_id;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getParentExternalId() : ?string
    {
        return $this->parent_external_id;
    }


    public function getParentId() : ?int
    {
        return $this->parent_id;
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


    public function getTypeId() : ?int
    {
        return $this->type_id;
    }


    public function getUpdated() : ?int
    {
        return $this->updated;
    }


    public function getUrl() : ?string
    {
        return $this->url;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
