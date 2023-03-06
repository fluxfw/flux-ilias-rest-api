<?php

namespace FluxIliasRestApi\Service\Role\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Role\RoleDiffDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\Role\RoleQuery;
use ILIAS\DI\RBACServices;

class CreateRoleCommand
{

    use RoleQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly RBACServices $ilias_rbac
    ) {

    }


    public static function new(
        ObjectService $object_service,
        RBACServices $ilias_rbac
    ) : static {
        return new static(
            $object_service,
            $ilias_rbac
        );
    }


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectById(
                $object_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            ),
            $diff
        );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createRole(
            $this->object_service->getObjectByRefId(
                $object_ref_id,
                false
            ),
            $diff
        );
    }


    private function createRole(?ObjectDto $object, RoleDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null || $object->ref_id === null) {
            return null;
        }

        $ilias_role = $this->newIliasRole();

        $ilias_role->setTitle($diff->title ?? "");

        $ilias_role->create();
        $this->ilias_rbac->admin()->assignRoleToFolder($ilias_role->getId(), $object->ref_id);

        $this->mapRoleDiff(
            $diff,
            $ilias_role
        );

        $ilias_role->update();

        return ObjectIdDto::new(
            $ilias_role->getId() ?: null,
            $diff->import_id
        );
    }
}
