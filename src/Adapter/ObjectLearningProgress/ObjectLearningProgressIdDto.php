<?php

namespace FluxIliasRestApi\Adapter\ObjectLearningProgress;

class ObjectLearningProgressIdDto
{

    private function __construct(
        public readonly ?int $object_id,
        public readonly ?string $object_import_id,
        public readonly ?int $object_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id
    ) {

    }


    public static function new(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : static {
        return new static(
            $object_id,
            $object_import_id,
            $object_ref_id,
            $user_id,
            $user_import_id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->object_id ?? null,
            $id->object_import_id ?? null,
            $id->object_ref_id ?? null,
            $id->user_id ?? null,
            $id->user_import_id ?? null
        );
    }
}
