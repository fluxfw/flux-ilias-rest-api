<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\StaffIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;
use ilOrgUnitUserAssignment;

class AddOrganisationalUnitStaffCommand
{

    use OrganisationalUnitQuery;

    private ilDBInterface $database;
    private OrganisationalUnitService $organisational_unit;
    private UserService $user;


    public static function new(ilDBInterface $database, OrganisationalUnitService $organisational_unit, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->organisational_unit = $organisational_unit;
        $command->user = $user;

        return $command;
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->addOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    private function addOrganisationalUnitStaff(?OrganisationalUnitDto $organisational_unit, ?UserDto $user, int $position_id) : ?StaffIdDto
    {
        if ($organisational_unit === null || $user === null) {
            return null;
        }

        $ilias_organisational_unit = $this->getIliasOrganisationalUnit(
            $organisational_unit->getId(),
            $organisational_unit->getRefId()
        );
        if ($ilias_organisational_unit === null) {
            return null;
        }

        $assignment = ilOrgUnitUserAssignment::where([
            "orgu_id"     => $organisational_unit->getRefId(),
            "user_id"     => $user->getId(),
            "position_id" => $position_id
        ])->first();
        if ($assignment === null) {
            $assignment = new ilOrgUnitUserAssignment();
            $assignment->setOrguId($organisational_unit->getRefId());
            $assignment->setUserId($user->getId());
            $assignment->setPositionId($position_id);
            $assignment->store();
        }

        return StaffIdDto::new(
            $organisational_unit->getId(),
            $organisational_unit->getExternalId(),
            $organisational_unit->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
