<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use ilDBInterface;

class PurgeChangesCommand
{

    use ChangeQuery;

    private ChangeService $change;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, ChangeService $change) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->change = $change;

        return $command;
    }


    public function purgeChanges() : ?int
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        return $this->database->manipulate($this->getChangePurgeQuery(
            $this->change->getKeepChangesInsideDays()
        ));
    }
}
