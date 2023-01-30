<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;

class GetObjectsCommand
{

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
     * @return ObjectDto[]
     */
    public function getObjects(ObjectType $type, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectQuery(
            $type,
            null,
            null,
            null,
            $title,
            null,
            $in_trash
        )));
        $object_ids = array_map(fn(array $object) : int => $object["obj_id"], $objects);

        $ref_ids_ = $ref_ids ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectRefIdsQuery($object_ids))) : null;

        return array_map(fn(array $object) : ObjectDto => $this->mapObjectDto(
            $object,
            $ref_ids_
        ), $objects);
    }
}
