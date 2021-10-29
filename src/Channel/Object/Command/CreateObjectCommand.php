<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;

class CreateObjectCommand
{

    use ObjectQuery;

    private ObjectService $object;


    public static function new(ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;

        return $command;
    }


    public function createObjectToId(string $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object->getObjectById(
                $parent_id
            ),
            $diff
        );
    }


    public function createObjectToImportId(string $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $diff
        );
    }


    public function createObjectToRefId(string $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createObject(
            $type,
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createObject(string $type, ?ObjectDto $parent_object, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        $ilias_object = $this->newIliasObject(
            $type
        );

        $ilias_object->setTitle($diff->getTitle() ?? "");

        $ilias_object->create();
        $ilias_object->createReference();
        $ilias_object->putInTree($parent_object->getRefId());
        $ilias_object->setPermissions($parent_object->getRefId());

        $this->mapObjectDiff(
            $diff,
            $ilias_object
        );

        $ilias_object->update();

        return ObjectIdDto::new(
            $ilias_object->getId() ?: null,
            $diff->getImportId(),
            $ilias_object->getRefId() ?: null
        );
    }
}
