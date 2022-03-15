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

    private ilDBInterface $ilias_database;
    private OrganisationalUnitPositionService $organisational_unit_position_service;
    private OrganisationalUnitService $organisational_unit_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service,
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ OrganisationalUnitPositionService $organisational_unit_position_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->organisational_unit_service = $organisational_unit_service;
        $this->user_service = $user_service;
        $this->organisational_unit_position_service = $organisational_unit_position_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        OrganisationalUnitService $organisational_unit_service,
        UserService $user_service,
        OrganisationalUnitPositionService $organisational_unit_position_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $organisational_unit_service,
            $user_service,
            $organisational_unit_position_service
        );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return AddOrganisationalUnitStaffCommand::new(
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->ilias_database
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
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
            $this->organisational_unit_service,
            $this->user_service,
            $this->organisational_unit_position_service
        )
            ->removeOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }
}
