<?php

namespace FluxIliasRestApi\Adapter\GroupMember;

class GroupMemberIdDto
{

    private function __construct(
        public readonly ?int $group_id,
        public readonly ?string $group_import_id,
        public readonly ?int $group_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id
    ) {

    }


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : static {
        return new static(
            $group_id,
            $group_import_id,
            $group_ref_id,
            $user_id,
            $user_import_id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->group_id ?? null,
            $id->group_import_id ?? null,
            $id->group_ref_id ?? null,
            $id->user_id ?? null,
            $id->user_import_id ?? null
        );
    }
}
