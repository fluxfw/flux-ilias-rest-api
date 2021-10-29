<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnit;

use JsonSerializable;

class OrganisationalUnitIdDto implements JsonSerializable
{

    private ?string $external_id;
    private ?int $id;
    private ?int $ref_id;


    public static function new(?int $id = null, ?string $external_id = null, ?int $ref_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->external_id = $external_id;
        $dto->ref_id = $ref_id;

        return $dto;
    }


    public function getExternalId() : ?string
    {
        return $this->external_id;
    }


    public function getId() : ?int
    {
        return $this->id;
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
