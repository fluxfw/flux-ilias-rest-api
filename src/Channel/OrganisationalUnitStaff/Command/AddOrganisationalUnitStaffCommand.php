<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\OrganisationalUnitStaffQuery;
use FluxIliasRestApi\Channel\User\Port\UserService;

class AddOrganisationalUnitStaffCommand
{

    use OrganisationalUnitStaffQuery;

    private OrganisationalUnitPositionService $organisational_unit_position_service;
    private OrganisationalUnitService $organisational_unit_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service,
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ OrganisationalUnitPositionService $organisational_unit_position_service
    ) {
        $this->organisational_unit_service = $organisational_unit_service;
        $this->user_service = $user_service;
        $this->organisational_unit_position_service = $organisational_unit_position_service;
    }


    public static function new(
        OrganisationalUnitService $organisational_unit_service,
        UserService $user_service,
        OrganisationalUnitPositionService $organisational_unit_position_service
    ) : /*static*/ self
    {
        return new static(
            $organisational_unit_service,
            $user_service,
            $organisational_unit_position_service
        );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitById(
                $id
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitById(
                $id
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    private function addOrganisationalUnitStaff(?OrganisationalUnitDto $organisational_unit, ?UserDto $user, ?OrganisationalUnitPositionDto $organisational_unit_position) : ?OrganisationalUnitStaffDto
    {
        if ($organisational_unit === null || $user === null || $organisational_unit_position === null) {
            return null;
        }

        $ilias_organisational_unit_staff = $this->getIliasOrganisationalUnitStaff(
            $organisational_unit->getRefId(),
            $user->getId(),
            $organisational_unit_position->getId()
        );
        if ($ilias_organisational_unit_staff === null) {
            $ilias_organisational_unit_staff = $this->newIliasOrganisationalUnitStaff();
            $ilias_organisational_unit_staff->setOrguId($organisational_unit->getRefId());
            $ilias_organisational_unit_staff->setUserId($user->getId());
            $ilias_organisational_unit_staff->setPositionId($organisational_unit_position->getId());
            $ilias_organisational_unit_staff->store();
        }

        return OrganisationalUnitStaffDto::new(
            $organisational_unit->getId(),
            $organisational_unit->getExternalId(),
            $organisational_unit->getRefId(),
            $user->getId(),
            $user->getImportId(),
            $organisational_unit_position->getId()
        );
    }
}
