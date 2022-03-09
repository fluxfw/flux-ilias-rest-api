<?php

namespace FluxIliasRestApi\Channel\UserRole\Command;

use FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use ILIAS\DI\RBACServices;

class RemoveUserRoleCommand
{

    private RBACServices $ilias_rbac;
    private RoleService $role_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ RoleService $role_service,
        /*private readonly*/ RBACServices $ilias_rbac
    ) {
        $this->user_service = $user_service;
        $this->role_service = $role_service;
        $this->ilias_rbac = $ilias_rbac;
    }


    public static function new(
        UserService $user_service,
        RoleService $role_service,
        RBACServices $ilias_rbac
    ) : /*static*/ self
    {
        return new static(
            $user_service,
            $role_service,
            $ilias_rbac
        );
    }


    public function removeUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return $this->removeUserRole(
            $this->user_service->getUserById(
                $id
            ),
            $this->role_service->getRoleById(
                $role_id
            )
        );
    }


    public function removeUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return $this->removeUserRole(
            $this->user_service->getUserById(
                $id
            ),
            $this->role_service->getRoleByImportId(
                $role_import_id
            )
        );
    }


    public function removeUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return $this->removeUserRole(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->role_service->getRoleById(
                $role_id
            )
        );
    }


    public function removeUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return $this->removeUserRole(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->role_service->getRoleByImportId(
                $role_import_id
            )
        );
    }


    private function removeUserRole(?UserDto $user, ?RoleDto $role) : ?UserRoleDto
    {
        if ($user === null || $role === null) {
            return null;
        }

        if ($this->ilias_rbac->review()->isAssigned($user->getId(), $role->getId())) {
            $this->ilias_rbac->admin()->deassignUser($role->getId(), $user->getId());
        }

        return UserRoleDto::new(
            $user->getId(),
            $user->getImportId(),
            $role->getId(),
            $role->getImportId()
        );
    }
}
