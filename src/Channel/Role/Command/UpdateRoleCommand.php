<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Role\RoleDiffDto;
use FluxIliasRestApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\Role\RoleQuery;

class UpdateRoleCommand
{

    use RoleQuery;

    private RoleService $role_service;


    private function __construct(
        /*private readonly*/ RoleService $role_service
    ) {
        $this->role_service = $role_service;
    }


    public static function new(
        RoleService $role_service
    ) : /*static*/ self
    {
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
