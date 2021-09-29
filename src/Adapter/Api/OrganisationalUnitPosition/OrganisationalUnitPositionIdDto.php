<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

use JsonSerializable;

class OrganisationalUnitPositionIdDto implements JsonSerializable
{

    private ?int $id;


    public static function new(?int $id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;

        return $dto;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
