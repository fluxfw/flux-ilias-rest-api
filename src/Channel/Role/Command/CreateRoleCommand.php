<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\Role\RoleQuery;
use ILIAS\DI\RBACServices;

class CreateRoleCommand
{

    use RoleQuery;

    private ObjectService $object;
    private RBACServices $rbac;


    public static function new(ObjectService $object, RBACServices $rbac) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->rbac = $rbac;

        return $command;
    }


    public function createRoleToId(int $parent_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectById(
                $parent_id
            ),
            $diff
        );
    }


    public function createRoleToImportId(string $parent_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $diff
        );
    }


    public function createRoleToRefId(int $parent_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createRole(?ObjectDto $parent_object, RoleDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_role = $this->newIliasRole();

        $ilias_role->setTitle($diff->getTitle() ?? "");

        $ilias_role->create();
        $this->rbac->admin()->assignRoleToFolder($ilias_role->getId(), $parent_object->getRefId());

        $this->mapRoleDiff(
            $diff,
            $ilias_role
        );

        $ilias_role->update();

        return ObjectIdDto::new(
            $ilias_role->getId() ?: null,
            $diff->getImportId()
        );
    }
}
