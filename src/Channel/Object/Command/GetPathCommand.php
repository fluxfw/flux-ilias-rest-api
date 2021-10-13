<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilTree;

class GetPathCommand
{

    use ObjectQuery;

    private ObjectService $object;
    private ilTree $tree;


    public static function new(ObjectService $object, ilTree $tree) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->tree = $tree;

        return $command;
    }


    public function getPathById(int $id) : ?array
    {
        return $this->getPath(
            $this->object->getObjectById(
                $id
            )
        );
    }


    public function getPathByImportId(string $import_id) : ?array
    {
        return $this->getPath(
            $this->object->getObjectByImportId(
                $import_id
            )
        );
    }


    public function getPathByRefId(int $ref_id) : ?array
    {
        return $this->getPath(
            $this->object->getObjectByRefId(
                $ref_id
            )
        );
    }


    private function getPath(?ObjectDto $object) : ?array
    {
        if ($object === null) {
            return null;
        }

        return array_map([$this->object, "getObjectByRefId"], $this->tree->getPathId($object->getRefId()));
    }
}
