<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use ilDBInterface;

class DropChangeDatabaseCommand
{

    use ChangeQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function dropChangeDatabase() : void
    {
        $this->ilias_database->dropTable($this->getChangeDatabaseTable(), false);
    }
}
