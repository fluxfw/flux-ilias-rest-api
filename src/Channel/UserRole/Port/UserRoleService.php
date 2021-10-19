<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserRole\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use Fluxlabs\FluxIliasRestApi\Channel\Role\Port\RoleService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\UserRole\Command\AddUserRoleCommand;
use Fluxlabs\FluxIliasRestApi\Channel\UserRole\Command\GetUserRolesCommand;
use Fluxlabs\FluxIliasRestApi\Channel\UserRole\Command\RemoveUserRoleCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class UserRoleService
{

    private ilDBInterface $database;
    private RBACServices $rbac;
    private RoleService $role;
    private UserService $user;


    public static function new(ilDBInterface $database, UserService $user, RoleService $role, RBACServices $rbac) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->user = $user;
        $service->role = $role;
        $service->rbac = $rbac;

        return $service;
    }


    public function addUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return AddUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->addUserRoleByIdByRoleId(
                $id,
                $role_id
            );
    }


    public function addUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return AddUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->addUserRoleByIdByRoleImportId(
                $id,
                $role_import_id
            );
    }


    public function addUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return AddUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->addUserRoleByImportIdByRoleId(
                $import_id,
                $role_id
            );
    }


    public function addUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return AddUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->addUserRoleByImportIdByRoleImportId(
                $import_id,
                $role_import_id
            );
    }


    public function getUserRoles(?int $user_id = null, ?string $user_import_id = null, ?int $role_id = null, ?string $role_import_id = null) : array
    {
        return GetUserRolesCommand::new(
            $this->database
        )
            ->getUserRoles(
                $user_id,
                $user_import_id,
                $role_id,
                $role_import_id
            );
    }


    public function removeUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return RemoveUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->removeUserRoleByIdByRoleId(
                $id,
                $role_id
            );
    }


    public function removeUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return RemoveUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->removeUserRoleByIdByRoleImportId(
                $id,
                $role_import_id
            );
    }


    public function removeUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return RemoveUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->removeUserRoleByImportIdByRoleId(
                $import_id,
                $role_id
            );
    }


    public function removeUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return RemoveUserRoleCommand::new(
            $this->user,
            $this->role,
            $this->rbac
        )
            ->removeUserRoleByImportIdByRoleImportId(
                $import_id,
                $role_import_id
            );
    }
}
