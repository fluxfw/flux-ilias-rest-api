<?php

namespace FluxIliasRestApi\Adapter\UserFavourite;

class UserFavouriteDto
{

    private function __construct(
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?int $object_id,
        public readonly ?string $object_import_id,
        public readonly ?int $object_ref_id
    ) {

    }


    public static function new(
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null
    ) : static {
        return new static(
            $user_id,
            $user_import_id,
            $object_id,
            $object_import_id,
            $object_ref_id
        );
    }


    public static function newFromObject(
        object $user_favourite
    ) : static {
        return static::new(
            $user_favourite->user_id ?? null,
            $user_favourite->user_import_id ?? null,
            $user_favourite->object_id ?? null,
            $user_favourite->object_import_id ?? null,
            $user_favourite->object_ref_id ?? null
        );
    }
}
