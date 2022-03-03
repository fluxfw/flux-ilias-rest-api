<?php

namespace FluxIliasRestApi\Channel\File\Command;

use FluxIliasRestApi\Channel\File\FileQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
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


    public function getFiles(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapFileDto"], $this->database->fetchAll($this->database->query($this->getFileQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
