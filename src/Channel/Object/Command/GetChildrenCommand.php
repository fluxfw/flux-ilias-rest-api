<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class GetChildrenCommand
{

    use ObjectQuery;

    private ilDBInterface $database;
    private ObjectService $object;


    public static function new(ObjectService $object, ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->database = $database;

        return $command;
    }


    public function getChildrenById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object->getObjectById(
            $id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            $object->getId(),
            null,
            null,
            $ref_ids,
            $in_trash
        );
    }


    public function getChildrenByImportId(string $import_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object->getObjectByImportId(
            $import_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            $object->getImportId(),
            null,
            $ref_ids,
            $in_trash
        );
    }


    public function getChildrenByRefId(int $ref_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object->getObjectByRefId(
            $ref_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            null,
            $object->getRefId(),
            $ref_ids,
            $in_trash
        );
    }


    private function getChildren(?int $id = null, ?string $import_id = null, ?int $ref_id = null, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        $objects = $this->database->fetchAll($this->database->query($this->getObjectChildrenQuery(
            $id,
            $import_id,
            $ref_id,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $ref_ids_ = $ref_ids ? $this->database->fetchAll($this->database->query($this->getObjectRefIdsQuery($object_ids))) : null;

        return array_map(fn(array $object) : ObjectDto => $this->mapObjectDto(
            $object,
            $ref_ids_
        ), $objects);
    }
}
