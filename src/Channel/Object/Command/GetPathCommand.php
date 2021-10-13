<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;
use ilTree;

class GetPathCommand
{

    use ObjectQuery;

    private ilDBInterface $database;
    private ObjectService $object;
    private ilTree $tree;


    public static function new(ObjectService $object, ilDBInterface $database, ilTree $tree) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->database = $database;
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
        if ($object === null || $object->getRefId() === null) {
            return null;
        }

        $ref_ids = $this->tree->getPathId($object->getRefId());
        $objects = $this->database->fetchAll($this->database->query($this->getObjectQuery(
            null,
            null,
            null,
            null,
            $ref_ids
        )));
        usort($objects, fn(array $object1, array $object2) : int => array_search($object1["ref_id"], $ref_ids) - array_search($object2["ref_id"], $ref_ids));

        return array_map([$this, "mapObjectDto"], $objects);
    }
}
