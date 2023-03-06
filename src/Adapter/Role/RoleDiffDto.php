<?php

namespace FluxIliasRestApi\Adapter\Role;

class RoleDiffDto
{

    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $title,
        public readonly ?string $description
    ) {

    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null
        );
    }
}
