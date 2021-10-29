<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class GetGlobalRoleObjectCommand
{

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return $this->object->getObjectByRefId(
            ROLE_FOLDER_ID
        );
    }
}
