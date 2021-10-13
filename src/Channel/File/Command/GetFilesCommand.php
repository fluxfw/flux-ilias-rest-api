<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\File\Command;

use Fluxlabs\FluxIliasRestApi\Channel\File\FileQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetFilesCommand
{

    use FileQuery;
    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getFiles() : array
    {
        return array_map([$this, "mapFileDto"], $this->database->fetchAll($this->database->query($this->getFileQuery())));
    }
}
