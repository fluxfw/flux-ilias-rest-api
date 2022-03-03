<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use ilDBInterface;

class GetChangesCommand
{

    use ChangeQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : ?array
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        return array_map([$this, "mapChangeDto"], $this->database->fetchAll($this->database->query($this->getChangeQuery(
            $from,
            $to,
            $after,
            $before
        ))));
    }
}
