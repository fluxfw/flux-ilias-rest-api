<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\StaffIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\AddOrganisationalUnitStaffCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\GetOrganisationalUnitStaffCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command\RemoveOrganisationalUnitStaffCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class OrganisationalUnitStaffService
{

    private ilDBInterface $database;
    private OrganisationalUnitService $organisational_unit;
    private UserService $user;


    public static function new(ilDBInterface $database, OrganisationalUnitService $organisational_unit, UserService $user) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->organisational_unit = $organisational_unit;
        $service->user = $user;

        return $service;
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->addOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->addOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->addOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->addOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->addOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
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


    public function removeOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return RemoveOrganisationalUnitStaffCommand::new(
            $this->database,
            $this->organisational_unit,
            $this->user
        )
            ->removeOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }
}
