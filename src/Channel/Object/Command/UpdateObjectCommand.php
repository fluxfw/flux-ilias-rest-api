<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class UpdateObjectCommand
{

    use ObjectQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object->getObjectById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object->getObjectByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateObject(
            $this->object->getObjectByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateObject(?ObjectDto $object, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($object === null) {
            return null;
        }

        $ilias_object = $this->getIliasObject(
            $object->getId(),
            $object->getRefId()
        );
        if ($ilias_object === null) {
            return null;
        }

        $this->mapObjectDiff(
            $diff,
            $ilias_object
        );

        $ilias_object->update();

        return ObjectIdDto::new(
            $object->getId(),
            $diff->getImportId() ?? $object->getImportId(),
            $object->getRefId()
        );
    }
}
