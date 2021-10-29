<?php

namespace FluxIliasRestApi\Adapter\Api\Role;

use JsonSerializable;

class RoleDto implements JsonSerializable
{

    private ?int $created;
    private ?string $description;
    private ?string $icon_url;
    private ?int $id;
    private ?string $import_id;
    private ?int $object_id;
    private ?string $object_import_id;
    private ?int $object_ref_id;
    private ?string $title;
    private ?int $updated;


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->object_id = $object_id;
        $dto->object_import_id = $object_import_id;
        $dto->object_ref_id = $object_ref_id;
        $dto->icon_url = $icon_url;
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


    public function getObjectId() : ?int
    {
        return $this->object_id;
    }


    public function getObjectImportId() : ?string
    {
        return $this->object_import_id;
    }


    public function getObjectRefId() : ?int
    {
        return $this->object_ref_id;
    }


    public function getTitle() : ?string
    {
        return $this->title;
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
