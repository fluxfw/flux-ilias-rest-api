<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\StaffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\OrganisationalUnitStaffQuery;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class AddOrganisationalUnitStaffCommand
{

    use OrganisationalUnitStaffQuery;

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
        $command = new static();

        $command->database = $database;
        $command->organisational_unit = $organisational_unit;
        $command->user = $user;
        $command->organisational_unit_position = $organisational_unit_position;

        return $command;
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?StaffDto
    {
        return $this->addOrganisationalUnitStaff(
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


    private function addOrganisationalUnitStaff(?OrganisationalUnitDto $organisational_unit, ?UserDto $user, ?OrganisationalUnitPositionDto $organisational_unit_position) : ?StaffDto
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

        return StaffDto::new(
            $organisational_unit->getId(),
            $organisational_unit->getExternalId(),
            $organisational_unit->getRefId(),
            $user->getId(),
            $user->getImportId(),
            $organisational_unit_position->getId()
        );
    }
}
