<?php

namespace FluxIliasRestApi\Adapter\Role;

class RoleDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $object_id,
        public readonly ?string $object_import_id,
        public readonly ?int $object_ref_id,
        public readonly ?string $title,
        public readonly ?string $description
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?string $title = null,
        ?string $description = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $created,
            $updated,
            $object_id,
            $object_import_id,
            $object_ref_id,
            $title,
            $description
        );
    }


    public static function newFromObject(
        object $role
    ) : static {
        return static::new(
            $role->id ?? null,
            $role->import_id ?? null,
            $role->created ?? null,
            $role->updated ?? null,
            $role->object_id ?? null,
            $role->object_import_id ?? null,
            $role->object_ref_id ?? null,
            $role->title ?? null,
            $role->description ?? null
        );
    }
}
