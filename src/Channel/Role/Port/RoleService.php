<?php

namespace FluxIliasRestApi\Channel\Role\Port;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\Role\Command\CreateRoleCommand;
use FluxIliasRestApi\Channel\Role\Command\GetGlobalRoleObjectCommand;
use FluxIliasRestApi\Channel\Role\Command\GetRoleCommand;
use FluxIliasRestApi\Channel\Role\Command\GetRolesCommand;
use FluxIliasRestApi\Channel\Role\Command\UpdateRoleCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class RoleService
{

    private ilDBInterface $database;
    private ObjectService $object;
    private RBACServices $rbac;


    public static function new(ilDBInterface $database, ObjectService $object, RBACServices $rbac) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->object = $object;
        $service->rbac = $rbac;

        return $service;
    }


    public function createRoleToId(int $parent_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object,
            $this->rbac
        )
            ->createRoleToId(
                $parent_id,
                $diff
            );
    }


    public function createRoleToImportId(string $parent_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object,
            $this->rbac
        )
            ->createRoleToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createRoleToRefId(int $parent_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object,
            $this->rbac
        )
            ->createRoleToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return GetGlobalRoleObjectCommand::new(
            $this->object
        )
            ->getGlobalRoleObject();
    }


    public function getRoleById(int $id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->database
        )
            ->getRoleById(
                $id
            );
    }


    public function getRoleByImportId(string $import_id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->database
        )
            ->getRoleByImportId(
                $import_id
            );
    }


    public function getRoles() : array
    {
        return GetRolesCommand::new(
            $this->database
        )
            ->getRoles();
    }


    public function updateRoleById(int $id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateRoleCommand::new(
            $this
        )
            ->updateRoleById(
                $id,
                $diff
            );
    }


    public function updateRoleByImportId(string $import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateRoleCommand::new(
            $this
        )
            ->updateRoleByImportId(
                $import_id,
                $diff
            );
    }
}
