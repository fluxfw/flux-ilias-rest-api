<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilTree;
use LogicException;

class MoveObjectCommand
{

    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilTree $ilias_tree
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilTree $ilias_tree
    ) : static {
        return new static(
            $object_service,
            $ilias_tree
        );
    }


    public function moveObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            )
        );
    }


    private function moveObject(?ObjectDto $object, ?ObjectDto $parent_object) : ?ObjectIdDto
    {
        if ($object === null || $parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        if ($object->id === $parent_object->id) {
            throw new LogicException("Can't move to its self");
        }

        if ($object->parent_ref_id !== $parent_object->ref_id) {
            $this->ilias_tree->moveTree($object->ref_id, $parent_object->ref_id);
        }

        return ObjectIdDto::new(
            $parent_object->id,
            $parent_object->import_id,
            $parent_object->ref_id
        );
    }
}
