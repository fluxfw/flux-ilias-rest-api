<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectType;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
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


    public function getObjects(ObjectType $type, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        $objects = $this->database->fetchAll($this->database->query($this->getObjectQuery(
            $type,
            null,
            null,
            null,
            null,
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
