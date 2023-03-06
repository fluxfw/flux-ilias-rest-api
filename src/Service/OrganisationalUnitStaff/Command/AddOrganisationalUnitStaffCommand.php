<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitStaff\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Service\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use FluxIliasRestApi\Service\OrganisationalUnitStaff\OrganisationalUnitStaffQuery;
use FluxIliasRestApi\Service\User\Port\UserService;

class AddOrganisationalUnitStaffCommand
{

    use OrganisationalUnitStaffQuery;

    private function __construct(
        private readonly OrganisationalUnitService $organisational_unit_service,
        private readonly UserService $user_service,
        private readonly OrganisationalUnitPositionService $organisational_unit_position_service
    ) {

    }


    public static function new(
        OrganisationalUnitService $organisational_unit_service,
        UserService $user_service,
        OrganisationalUnitPositionService $organisational_unit_position_service
    ) : static {
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
            $organisational_unit->ref_id,
            $user->id,
            $organisational_unit_position->id
        );
        if ($ilias_organisational_unit_staff === null) {
            $ilias_organisational_unit_staff = $this->newIliasOrganisationalUnitStaff();
            $ilias_organisational_unit_staff->setOrguId($organisational_unit->ref_id);
            $ilias_organisational_unit_staff->setUserId($user->id);
            $ilias_organisational_unit_staff->setPositionId($organisational_unit_position->id);
            $ilias_organisational_unit_staff->store();
        }

        return OrganisationalUnitStaffDto::new(
            $organisational_unit->id,
            $organisational_unit->external_id,
            $organisational_unit->ref_id,
            $user->id,
            $user->import_id,
            $organisational_unit_position->id
        );
    }
}
