<?php

namespace FluxIliasRestApi\Adapter\Constants;

class ConstantsDto
{

    private function __construct(
        public readonly int $root_object_ref_id,
        public readonly int $system_settings_object_ref_id,
        public readonly int $restored_objects_object_ref_id,
        public readonly int $organisational_unit_root_object_id,
        public readonly int $organisational_unit_root_object_ref_id,
        public readonly int $user_management_object_ref_id,
        public readonly int $root_user_id,
        public readonly int $anonymous_user_id,
        public readonly int $roles_object_ref_id,
        public readonly int $administrator_role_id,
        public readonly int $anonymous_role_id,
        public readonly int $guest_role_id,
        public readonly int $user_role_id
    )
    {

    }


    public static function new(
        int $root_object_ref_id,
        int $system_settings_object_ref_id,
        int $restored_objects_object_ref_id,
        int $organisational_unit_root_object_id,
        int $organisational_unit_root_object_ref_id,
        int $user_management_object_ref_id,
        int $root_user_id,
        int $anonymous_user_id,
        int $roles_object_ref_id,
        int $administrator_role_id,
        int $anonymous_role_id,
        int $guest_role_id,
        int $user_role_id
    ) : static
    {
        return new static(
            $root_object_ref_id,
            $system_settings_object_ref_id,
            $restored_objects_object_ref_id,
            $organisational_unit_root_object_id,
            $organisational_unit_root_object_ref_id,
            $user_management_object_ref_id,
            $root_user_id,
            $anonymous_user_id,
            $roles_object_ref_id,
            $administrator_role_id,
            $anonymous_role_id,
            $guest_role_id,
            $user_role_id
        );
    }
}
