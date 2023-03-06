<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Permission\Permission;
use FluxIliasRestApi\Service\Permission\PermissionMapping;
use ilAccessHandler;

class HasAccessByRefIdByUserIdCommand
{

    private function __construct(
        private readonly ilAccessHandler $ilias_access
    ) {

    }


    public static function new(
        ilAccessHandler $ilias_access
    ) : static {
        return new static(
            $ilias_access
        );
    }


    public function hasAccessByRefIdByUserId(int $ref_id, int $user_id, Permission $permission) : bool
    {
        return $this->ilias_access->checkAccessOfUser($user_id, PermissionMapping::mapExternalToInternal($permission)->value, "", $ref_id);
    }
}
