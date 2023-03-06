<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnitStaff;

class OrganisationalUnitStaffDto
{

    private function __construct(
        public readonly ?int $organisational_unit_id,
        public readonly ?string $organisational_unit_external_id,
        public readonly ?int $organisational_unit_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?int $position_id
    ) {

    }


    public static function new(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : static {
        return new static(
            $organisational_unit_id,
            $organisational_unit_external_id,
            $organisational_unit_ref_id,
            $user_id,
            $user_import_id,
            $position_id
        );
    }


    public static function newFromObject(
        object $organisational_unit_staff
    ) : static {
        return static::new(
            $organisational_unit_staff->organisational_unit_id ?? null,
            $organisational_unit_staff->organisational_unit_external_id ?? null,
            $organisational_unit_staff->organisational_unit_ref_id ?? null,
            $organisational_unit_staff->user_id ?? null,
            $organisational_unit_staff->user_import_id ?? null,
            $organisational_unit_staff->position_id ?? null
        );
    }
}
