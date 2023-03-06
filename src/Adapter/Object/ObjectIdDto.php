<?php

namespace FluxIliasRestApi\Adapter\Object;

class ObjectIdDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->id ?? null,
            $id->import_id ?? null,
            $id->ref_id ?? null
        );
    }
}
