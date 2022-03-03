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


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectById(
                $object_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectByImportId(
                $object_import_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object->getObjectByRefId(
                $object_ref_id,
                false
            ),
            $diff
        );
    }


    private function createRole(?ObjectDto $object, RoleDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null || $object->getRefId() === null) {
            return null;
        }

        $ilias_role = $this->newIliasRole();

        $ilias_role->setTitle($diff->getTitle() ?? "");

        $ilias_role->create();
        $this->rbac->admin()->assignRoleToFolder($ilias_role->getId(), $object->getRefId());

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
