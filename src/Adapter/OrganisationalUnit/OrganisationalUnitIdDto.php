<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnit;

class OrganisationalUnitIdDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $external_id,
        public readonly ?int $ref_id
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $external_id = null,
        ?int $ref_id = null
    ) : static {
        return new static(
            $id,
            $external_id,
            $ref_id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->id ?? null,
            $id->external_id ?? null,
            $id->ref_id ?? null
        );
    }
}
