<?php

namespace FluxIliasRestApi\Service\UserRole\Command;

use FluxIliasRestApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\UserRole\UserRoleDto;
use FluxIliasRestApi\Service\Role\Port\RoleService;
use FluxIliasRestApi\Service\User\Port\UserService;
use ILIAS\DI\RBACServices;

class AddUserRoleCommand
{

    private function __construct(
        private readonly UserService $user_service,
        private readonly RoleService $role_service,
        private readonly RBACServices $ilias_rbac
    ) {

    }


    public static function new(
        UserService $user_service,
        RoleService $role_service,
        RBACServices $ilias_rbac
    ) : static {
        return new static(
            $user_service,
            $role_service,
            $ilias_rbac
        );
    }


    public function addUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return $this->addUserRole(
            $this->user_service->getUserById(
                $id
            ),
            $this->role_service->getRoleById(
                $role_id
            )
        );
    }


    public function addUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return $this->addUserRole(
            $this->user_service->getUserById(
                $id
            ),
            $this->role_service->getRoleByImportId(
                $role_import_id
            )
        );
    }


    public function addUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return $this->addUserRole(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->role_service->getRoleById(
                $role_id
            )
        );
    }


    public function addUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return $this->addUserRole(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->role_service->getRoleByImportId(
                $role_import_id
            )
        );
    }


    private function addUserRole(?UserDto $user, ?RoleDto $role) : ?UserRoleDto
    {
        if ($user === null || $role === null) {
            return null;
        }

        if (!$this->ilias_rbac->review()->isAssigned($user->id, $role->id)) {
            $this->ilias_rbac->admin()->assignUser($role->id, $user->id);
        }

        return UserRoleDto::new(
            $user->id,
            $user->import_id,
            $role->id,
            $role->import_id
        );
    }
}
