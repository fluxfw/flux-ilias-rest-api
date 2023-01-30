<?php

namespace FluxIliasRestApi\Service\File\Command;

use FluxIliasBaseApi\Adapter\File\FileDto;
use FluxIliasRestApi\Service\File\FileQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;

class GetFilesCommand
{

    use FileQuery;
    use ObjectQuery;

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


    /**
     * @return FileDto[]
     */
    public function getFiles(?bool $in_trash = null) : array
    {
        return array_map([$this, "mapFileDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getFileQuery(
            null,
            null,
            null,
            $in_trash
        ))));
    }
}
