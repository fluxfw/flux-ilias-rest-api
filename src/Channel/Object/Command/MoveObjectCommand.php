<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
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


    public function moveObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function moveObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function moveObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    public function moveObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->moveObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    private function moveObject(?ObjectDto $object, ?ObjectDto $new_parent_object) : ?ObjectIdDto
    {
        if ($object === null || $new_parent_object === null) {
            return null;
        }

        if ($object->getId() === $new_parent_object->getId()) {
            throw new LogicException("Can't move to its self");
        }

        if ($object->getParentRefId() !== $new_parent_object->getRefId()) {
            $this->tree->moveTree($object->getRefId(), $new_parent_object->getRefId());
        }

        return ObjectIdDto::new(
            $new_parent_object->getId(),
            $new_parent_object->getImportId(),
            $new_parent_object->getRefId()
        );
    }
}
