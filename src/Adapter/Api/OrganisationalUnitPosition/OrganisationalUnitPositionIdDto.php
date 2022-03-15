<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

use JsonSerializable;

class OrganisationalUnitPositionIdDto implements JsonSerializable
{

    private ?int $id;


    private function __construct(
        /*public readonly*/ ?int $id
    ) {
        $this->id = $id;
    }


    public static function new(
        ?int $id = null
    ) : /*static*/ self
    {
        return new static(
            $id
        );
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
