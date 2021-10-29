<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

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
