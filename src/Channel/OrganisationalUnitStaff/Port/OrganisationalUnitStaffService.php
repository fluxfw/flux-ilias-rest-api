<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\AddOrganisationalUnitStaffCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\GetOrganisationalUnitStaffCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\RemoveOrganisationalUnitStaffCommand;
use FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class OrganisationalUnitStaffService
{

    private ilDBInterface $database;
    private OrganisationalUnitService $organisational_unit;
    private OrganisationalUnitPositionService $organisational_unit_position;
    private UserService $user;


    public static function new(
        ilDBInterface $database,
        OrganisationalUnitService $organisational_unit,
        UserService $user,
        OrganisationalUnitPositionService $organisational_unit_position
    ) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->organisational_unit = $organisational_unit;
        $service->user = $user;
        $service->organisational_unit_position = $organisational_unit_position;

        return $service;
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->addOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }


    public function getOrganisationalUnitStaff(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : array {
        return GetOrganisationalUnitStaffCommand::new(
            $this->database
        )
            ->getOrganisationalUnitStaff(
                $organisational_unit_id,
                $organisational_unit_external_id,
                $organisational_unit_ref_id,
                $user_id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->organisational_unit,
            $this->user,
            $this->organisational_unit_position
        )
            ->removeOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }
}
