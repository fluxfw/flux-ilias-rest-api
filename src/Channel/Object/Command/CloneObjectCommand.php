<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use LogicException;

class CloneObjectCommand
{

    use ObjectQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function cloneObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function cloneObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function cloneObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectById(
                $new_parent_id
            )
        );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByImportId(
                $new_parent_import_id
            )
        );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByRefId(
                $new_parent_ref_id
            )
        );
    }


    private function cloneObject(?ObjectDto $object, ?ObjectDto $new_parent_object) : ?ObjectIdDto
    {
        if ($object === null || $new_parent_object === null) {
            return null;
        }

        if ($object->getId() === $new_parent_object->getId()) {
            throw new LogicException("Can't clone to its self");
        }

        $ilias_object = $this->getIliasObject(
            $object->getId(),
            $object->getRefId()
        );
        if ($ilias_object === null) {
            return null;
        }

        $new_ilias_object = $ilias_object->cloneObject($new_parent_object->getRefId());

        return ObjectIdDto::new(
            $new_ilias_object->getId() ?: null,
            $new_ilias_object->getImportId() ?: null,
            $new_ilias_object->getRefId() ?: null
        );
    }
}
