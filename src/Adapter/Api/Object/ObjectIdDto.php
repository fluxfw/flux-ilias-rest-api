<?php

namespace FluxIliasRestApi\Adapter\Api\Object;

use JsonSerializable;

class ObjectIdDto implements JsonSerializable
{

    private ?int $id;
    private ?string $import_id;
    private ?int $ref_id;


    public static function new(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->ref_id = $ref_id;

        return $dto;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getRefId() : ?int
    {
        return $this->ref_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
