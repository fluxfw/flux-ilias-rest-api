<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilTree;
use LogicException;

class MoveObjectCommand
{

    use ObjectQuery;

    private ilTree $ilias_tree;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ilTree $ilias_tree
    ) {
        $this->object_service = $object_service;
        $this->ilias_tree = $ilias_tree;
    }


    public static function new(
        ObjectService $object_service,
        ilTree $ilias_tree
    ) : /*static*/ self
    {
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
        if ($object === null || $parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        if ($object->getId() === $parent_object->getId()) {
            throw new LogicException("Can't move to its self");
        }

        if ($object->getParentRefId() !== $parent_object->getRefId()) {
            $this->ilias_tree->moveTree($object->getRefId(), $parent_object->getRefId());
        }

        return ObjectIdDto::new(
            $parent_object->getId(),
            $parent_object->getImportId(),
            $parent_object->getRefId()
        );
    }
}
