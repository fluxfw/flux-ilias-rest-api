<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Role\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;

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
