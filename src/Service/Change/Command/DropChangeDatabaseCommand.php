<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\ChangeQuery;
use ilDBInterface;

class DropChangeDatabaseCommand
{

    use ChangeQuery;

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


    public function dropChangeDatabase() : void
    {
        $this->ilias_database->dropTable($this->getChangeDatabaseTable(), false);
    }
}
