<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnitStaff;

use JsonSerializable;

class OrganisationalUnitStaffDto implements JsonSerializable
{

    private ?string $organisational_unit_external_id;
    private ?int $organisational_unit_id;
    private ?int $organisational_unit_ref_id;
    private ?int $position_id;
    private ?int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $organisational_unit_id,
        /*public readonly*/ ?string $organisational_unit_external_id,
        /*public readonly*/ ?int $organisational_unit_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?int $position_id
    ) {
        $this->organisational_unit_id = $organisational_unit_id;
        $this->organisational_unit_external_id = $organisational_unit_external_id;
        $this->organisational_unit_ref_id = $organisational_unit_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->position_id = $position_id;
    }


    public static function new(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : /*static*/ self
    {
        return new static(
            $organisational_unit_id,
            $organisational_unit_external_id,
            $organisational_unit_ref_id,
            $user_id,
            $user_import_id,
            $position_id
        );
    }


    public function getOrganisationalUnitExternalId() : ?string
    {
        return $this->organisational_unit_external_id;
    }


    public function getOrganisationalUnitId() : ?int
    {
        return $this->organisational_unit_id;
    }


    public function getOrganisationalUnitRefId() : ?int
    {
        return $this->organisational_unit_ref_id;
    }


    public function getPositionId() : ?int
    {
        return $this->position_id;
    }


    public function getUserId() : ?int
    {
        return $this->user_id;
    }


    public function getUserImportId() : ?string
    {
        return $this->user_import_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
