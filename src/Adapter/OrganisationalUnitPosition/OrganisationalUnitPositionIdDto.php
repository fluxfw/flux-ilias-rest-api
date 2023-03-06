<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnitPosition;

class OrganisationalUnitPositionIdDto
{

    private function __construct(
        public readonly ?int $id
    ) {

    }


    public static function new(
        ?int $id = null
    ) : static {
        return new static(
            $id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->id ?? null
        );
    }
}
