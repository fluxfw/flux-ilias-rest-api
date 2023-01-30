<?php

namespace FluxIliasRestApi\Service\ObjectConfig\Command;

use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class DeleteObjectConfigCommand
{

    use ObjectConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function deleteObjectConfig(int $id) : void
    {
        ilContainer::_deleteContainerSettings($id);
    }
}
