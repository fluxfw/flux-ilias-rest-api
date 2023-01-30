<?php

namespace FluxIliasRestApi\Service\Role\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasBaseApi\Adapter\Role\RoleDiffDto;
use FluxIliasBaseApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Service\Role\Port\RoleService;
use FluxIliasRestApi\Service\Role\RoleQuery;

class UpdateRoleCommand
{

    use RoleQuery;

    private function __construct(
        private readonly RoleService $role_service
    ) {

    }


    public static function new(
        RoleService $role_service
    ) : static {
        return new static(
            $role_service
        );
    }


    public function updateRoleById(int $id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateRole(
            $this->role_service->getRoleById(
                $id
            ),
            $diff
        );
    }


    public function updateRoleByImportId(string $import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateRole(
            $this->role_service->getRoleByImportId(
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
            $role->id
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
            $role->id,
            $diff->import_id ?? $role->import_id
        );
    }
}
