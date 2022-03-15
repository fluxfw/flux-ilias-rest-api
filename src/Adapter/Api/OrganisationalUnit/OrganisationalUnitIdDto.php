<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnit;

use JsonSerializable;

class OrganisationalUnitIdDto implements JsonSerializable
{

    private ?string $external_id;
    private ?int $id;
    private ?int $ref_id;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $external_id,
        /*public readonly*/ ?int $ref_id
    ) {
        $this->id = $id;
        $this->external_id = $external_id;
        $this->ref_id = $ref_id;
    }


    public static function new(
        ?int $id = null,
        ?string $external_id = null,
        ?int $ref_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $external_id,
            $ref_id
        );
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
