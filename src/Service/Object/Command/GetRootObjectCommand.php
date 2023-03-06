<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;

class GetRootObjectCommand
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


    public function getRootObject() : ?ObjectDto
    {
        return $this->object_service->getObjectByRefId(
            ROOT_FOLDER_ID
        );
    }
}
