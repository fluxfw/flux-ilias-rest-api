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

    private ilDBInterface $ilias_database;
    private RBACServices $ilias_rbac;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ RBACServices $ilias_rbac
    ) {
        $this->ilias_database = $ilias_database;
        $this->object_service = $object_service;
        $this->ilias_rbac = $ilias_rbac;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service,
        RBACServices $ilias_rbac
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $object_service,
            $ilias_rbac
        );
    }


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToId(
                $object_id,
                $diff
            );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToImportId(
                $object_import_id,
                $diff
            );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return CreateRoleCommand::new(
            $this->object_service,
            $this->ilias_rbac
        )
            ->createRoleToRefId(
                $object_ref_id,
                $diff
            );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return GetGlobalRoleObjectCommand::new(
            $this->object_service
        )
            ->getGlobalRoleObject();
    }


    public function getRoleById(int $id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->ilias_database
        )
            ->getRoleById(
                $id
            );
    }


    public function getRoleByImportId(string $import_id) : ?RoleDto
    {
        return GetRoleCommand::new(
            $this->ilias_database
        )
            ->getRoleByImportId(
                $import_id
            );
    }


    public function getRoles() : array
    {
        return GetRolesCommand::new(
            $this->ilias_database
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
