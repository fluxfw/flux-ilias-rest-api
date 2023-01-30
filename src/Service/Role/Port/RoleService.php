<?php

namespace FluxIliasRestApi\Service\Role\Port;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasBaseApi\Adapter\Role\RoleDiffDto;
use FluxIliasBaseApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\Role\Command\CreateRoleCommand;
use FluxIliasRestApi\Service\Role\Command\GetGlobalRoleObjectCommand;
use FluxIliasRestApi\Service\Role\Command\GetRoleCommand;
use FluxIliasRestApi\Service\Role\Command\GetRolesCommand;
use FluxIliasRestApi\Service\Role\Command\UpdateRoleCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class RoleService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ObjectService $object_service,
        private readonly RBACServices $ilias_rbac
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service,
        RBACServices $ilias_rbac
    ) : static {
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


    /**
     * @return RoleDto[]
     */
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
