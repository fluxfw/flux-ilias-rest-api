<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
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


    public function getPathById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getPath(
            $this->object->getObjectById(
                $id,
                $in_trash
            ),
            $ref_ids,
            $in_trash
        );
    }


    public function getPathByImportId(string $import_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getPath(
            $this->object->getObjectByImportId(
                $import_id,
                $in_trash
            ),
            $ref_ids,
            $in_trash
        );
    }


    public function getPathByRefId(int $ref_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getPath(
            $this->object->getObjectByRefId(
                $ref_id,
                $in_trash
            ),
            $ref_ids,
            $in_trash
        );
    }


    private function getPath(?ObjectDto $object, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        if ($object === null || $object->getRefId() === null) {
            return null;
        }

        $path_ref_ids = $this->tree->getPathId($object->getRefId());
        $objects = $this->database->fetchAll($this->database->query($this->getObjectQuery(
            null,
            null,
            null,
            null,
            $path_ref_ids,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $ref_ids_ = $ref_ids ? $this->database->fetchAll($this->database->query($this->getObjectRefIdsQuery($object_ids))) : null;

        usort($objects, fn(array $object1, array $object2) : int => array_search($object1["ref_id"] ?: null, $path_ref_ids) - array_search($object2["ref_id"] ?: null, $path_ref_ids));

        return array_map(fn(array $object) : ObjectDto => $this->mapObjectDto(
            $object,
            $ref_ids_
        ), $objects);
    }
}
