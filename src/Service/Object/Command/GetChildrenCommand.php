<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class GetChildrenCommand
{

    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $object_service,
            $ilias_database
        );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getChildrenById(int $id, ?ObjectType $type = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectById(
            $id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            $object->id,
            null,
            null,
            $type,
            $title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getChildrenByImportId(string $import_id, ?ObjectType $type = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectByImportId(
            $import_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            $object->import_id,
            null,
            $type,
            $title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getChildrenByRefId(int $ref_id, ?ObjectType $type = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        $object = $this->object_service->getObjectByRefId(
            $ref_id,
            $in_trash
        );
        if ($object === null) {
            return null;
        }

        return $this->getChildren(
            null,
            null,
            $object->ref_id,
            $type,
            $title,
            $ref_ids,
            $in_trash
        );
    }


    /**
     * @return ObjectDto[]
     */
    private function getChildren(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?ObjectType $type = null,
        ?string $title = null,
        bool $ref_ids = false,
        ?bool $in_trash = null
    ) : array {
        $objects = $this->ilias_database->fetchAll($this->ilias_database->query($this->getObjectChildrenQuery(
            $id,
            $import_id,
            $ref_id,
            $type,
            $title,
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
