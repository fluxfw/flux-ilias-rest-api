<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\StaffIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\OrganisationalUnitStaffQuery;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class RemoveOrganisationalUnitStaffCommand
{

    use OrganisationalUnitQuery;
    use OrganisationalUnitStaffQuery;

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


    public function removeOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    public function removeOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function removeOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $position_id
        );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?StaffIdDto
    {
        return $this->removeOrganisationalUnitStaff(
            $this->organisational_unit->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $position_id
        );
    }


    private function removeOrganisationalUnitStaff(?OrganisationalUnitDto $organisational_unit, ?UserDto $user, int $position_id) : ?StaffIdDto
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

        $assignment = $this->getIliasOrganisationalUnitStaff(
            $organisational_unit->getRefId(),
            $user->getId(),
            $position_id
        );
        if ($assignment !== null) {
            $assignment->delete();
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
