<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;
use ilTree;

class GetPathCommand
{

    use ObjectQuery;

    private ilDBInterface $ilias_database;
    private ilTree $ilias_tree;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ilTree $ilias_tree
    ) {
        $this->object_service = $object_service;
        $this->ilias_database = $ilias_database;
        $this->ilias_tree = $ilias_tree;
    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database,
        ilTree $ilias_tree
    ) : /*static*/ self
    {
        return new static(
            $object_service,
            $ilias_database,
            $ilias_tree
        );
    }


    public function getPathById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getPath(
            $this->object_service->getObjectById(
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
            $this->object_service->getObjectByImportId(
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
            $this->object_service->getObjectByRefId(
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

        $path_ref_ids = $this->ilias_tree->getPathId($object->getRefId());
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectQuery(
            null,
            null,
            null,
            null,
            $path_ref_ids,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $ref_ids_ = $ref_ids ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery($object_ids))) : null;

        usort($objects, fn(array $object1, array $object2) : int => array_search($object1["ref_id"] ?: null, $path_ref_ids) - array_search($object2["ref_id"] ?: null, $path_ref_ids));

        return array_map(fn(array $object) : ObjectDto => $this->mapObjectDto(
            $object,
            $ref_ids_
        ), $objects);
    }
}
