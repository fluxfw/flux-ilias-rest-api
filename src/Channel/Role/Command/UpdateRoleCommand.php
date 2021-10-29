<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\Role\RoleQuery;

class UpdateRoleCommand
{

    use RoleQuery;

    private RoleService $role;


    public static function new(RoleService $role) : /*static*/ self
    {
        $command = new static();

        $command->role = $role;

        return $command;
    }


    public function updateRoleById(int $id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateRole(
            $this->role->getRoleById(
                $id
            ),
            $diff
        );
    }


    public function updateRoleByImportId(string $import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateRole(
            $this->role->getRoleByImportId(
                $import_id
            ),
            $diff
        );
    }


    private function updateRole(?RoleDto $role, RoleDiffDto $diff) : ?ObjectIdDto
    {
        if ($role === null) {
            return null;
        }

        $ilias_role = $this->getIliasRole(
            $role->getId()
        );
        if ($ilias_role === null) {
            return null;
        }

        $this->mapRoleDiff(
            $diff,
            $ilias_role
        );

        $ilias_role->update();

        return ObjectIdDto::new(
            $role->getId(),
            $diff->getImportId() ?? $role->getImportId()
        );
    }
}
