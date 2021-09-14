<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetObjectsCommand
{

    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getObjects(string $type) : array
    {
        return array_map([$this, "mapDto"], $this->database->fetchAll($this->database->query($this->getObjectsQuery(
            $type
        ))));
    }
}
