<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilTree;
use LogicException;

class MoveObjectCommand
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


    public function moveObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id,
                false
            ),
            $this->object->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id,
                false
            ),
            $this->object->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id,
                false
            ),
            $this->object->getObjectByRefId(
                $parent_ref_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object->getObjectByRefId(
                $parent_ref_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object->getObjectById(
                $parent_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object->getObjectByImportId(
                $parent_import_id,
                false
            )
        );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object->getObjectByRefId(
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
            $this->tree->moveTree($object->getRefId(), $parent_object->getRefId());
        }

        return ObjectIdDto::new(
            $parent_object->getId(),
            $parent_object->getImportId(),
            $parent_object->getRefId()
        );
    }
}
