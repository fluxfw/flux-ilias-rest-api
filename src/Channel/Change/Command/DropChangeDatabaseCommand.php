<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use ilDBInterface;

class DropChangeDatabaseCommand
{

    use ChangeQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function dropChangeDatabase() : void
    {
        $this->database->dropTable($this->getChangeDatabaseTable(), false);
    }
}
