<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\Object;

use JsonSerializable;

class ObjectDto implements JsonSerializable
{

    private ?int $created;
    private ?string $description;
    private ?int $id;
    private ?string $import_id;
    private ?bool $online;
    private ?int $parent_id;
    private ?string $parent_import_id;
    private ?int $parent_ref_id;
    private ?int $ref_id;
    private ?string $title;
    private ?string $type;
    private ?int $updated;


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?string $type = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?bool $online = null,
        ?string $title = null,
        ?string $description = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->ref_id = $ref_id;
        $dto->type = $type;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->parent_id = $parent_id;
        $dto->parent_import_id = $parent_import_id;
        $dto->parent_ref_id = $parent_ref_id;
        $dto->online = $online;
        $dto->title = $title;
        $dto->description = $description;

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


    public function getType() : ?string
    {
        return $this->type;
    }


    public function getUpdated() : ?int
    {
        return $this->updated;
    }


    public function isOnline() : ?bool
    {
        return $this->online;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
