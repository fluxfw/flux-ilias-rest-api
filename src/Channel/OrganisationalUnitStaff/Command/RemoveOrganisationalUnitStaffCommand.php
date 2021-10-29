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

class RemoveOrganisationalUnitStaffCommand
{

    use OrganisationalUnitStaffQuery;

    private OrganisationalUnitService $organisational_unit;
    private OrganisationalUnitPositionService $organisational_unit_position;
    private UserService $user;


    public static function new(OrganisationalUnitService $organisational_unit, UserService $user, OrganisationalUnitPositionService $organisational_unit_position) : /*static*/ self
    {
        $command = new static();

        $command->organisational_unit = $organisational_unit;
        $command->user = $user;
        $command->organisational_unit_position = $organisational_unit_position;

        return $command;
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function removeOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function removeOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $position_id
            )
        );
    }


    private function removeOrganisationalUnitStaff(
        ?OrganisationalUnitDto $organisational_unit,
        ?UserDto $user,
        ?OrganisationalUnitPositionDto $organisational_unit_position
    ) : ?OrganisationalUnitStaffDto {
        if ($organisational_unit === null || $user === null || $organisational_unit_position === null) {
            return null;
        }

        $ilias_organisational_unit_staff = $this->getIliasOrganisationalUnitStaff(
            $organisational_unit->getRefId(),
            $user->getId(),
            $organisational_unit_position->getId()
        );
        if ($ilias_organisational_unit_staff !== null) {
            $ilias_organisational_unit_staff->delete();
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
