<?php

namespace FluxIliasRestApi\Service\ObjectConfig\Command;

use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigQuery;
use ilDBInterface;

class DeleteObjectConfigsCommand
{

    use ObjectConfigQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    public function deleteObjectConfigs() : void
    {
        $this->ilias_database->manipulate($this->getDeleteObjectConfigsQuery());
    }
}
