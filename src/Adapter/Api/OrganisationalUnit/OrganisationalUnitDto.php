<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit;

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


    public static function new(
        ?int $id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_external_id = null,
        ?int $parent_ref_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $type_id = null,
        ?string $external_id = null,
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->ref_id = $ref_id;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->parent_id = $parent_id;
        $dto->parent_external_id = $parent_external_id;
        $dto->parent_ref_id = $parent_ref_id;
        $dto->title = $title;
        $dto->description = $description;
        $dto->type_id = $type_id;
        $dto->external_id = $external_id;
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


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
