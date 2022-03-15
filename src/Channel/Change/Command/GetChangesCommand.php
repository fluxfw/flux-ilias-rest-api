<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use ilDBInterface;

class GetChangesCommand
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


    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : ?array
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        return array_map([$this, "mapChangeDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getChangeQuery(
            $from,
            $to,
            $after,
            $before
        ))));
    }
}
