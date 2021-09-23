<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;

class GetRootObjectCommand
{

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function getRootObject() : ?ObjectDto
    {
        return $this->object->getObjectByRefId(
            ROOT_FOLDER_ID
        );
    }
}
