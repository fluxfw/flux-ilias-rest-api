<?php

namespace FluxIliasRestApi\Service\Role\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;

class GetGlobalRoleObjectCommand
{

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
        return new static(
            $object_service
        );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return $this->object_service->getObjectByRefId(
            ROLE_FOLDER_ID
        );
    }
}
