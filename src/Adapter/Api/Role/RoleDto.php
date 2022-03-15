<?php

namespace FluxIliasRestApi\Adapter\Api\Role;

use JsonSerializable;

class RoleDto implements JsonSerializable
{

    private ?int $created;
    private ?string $description;
    private ?int $id;
    private ?string $import_id;
    private ?int $object_id;
    private ?string $object_import_id;
    private ?int $object_ref_id;
    private ?string $title;
    private ?int $updated;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $object_id,
        /*public readonly*/ ?string $object_import_id,
        /*public readonly*/ ?int $object_ref_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->object_id = $object_id;
        $this->object_import_id = $object_import_id;
        $this->object_ref_id = $object_ref_id;
        $this->title = $title;
        $this->description = $description;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?string $title = null,
        ?string $description = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id,
            $created,
            $updated,
            $object_id,
            $object_import_id,
            $object_ref_id,
            $title,
            $description
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
