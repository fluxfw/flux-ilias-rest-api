<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilObjOrgUnit;
use ilObjRole;
use ilObjUser;
use ilRepUtil;

class DeleteObjectCommand
{

    use ObjectQuery;

    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->object_service = $object_service;
    }


    public static function new(
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $object_service
        );
    }


    public function deleteObjectById(int $id, bool $force = false) : ?ObjectIdDto
    {
        return $this->deleteObject(
            $this->object_service->getObjectById(
                $id,
                $force
            ),
            $force
        );
    }


    public function deleteObjectByImportId(string $import_id, bool $force = false) : ?ObjectIdDto
    {
        return $this->deleteObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                $force
            ),
            $force
        );
    }


    public function deleteObjectByRefId(int $ref_id, bool $force = false) : ?ObjectIdDto
    {
        return $this->deleteObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                $force
            ),
            $force
        );
    }


    private function deleteObject(?ObjectDto $object, bool $force = false) : ?ObjectIdDto
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

        if ($force || $object->getRefId() === null || $object->getParentRefId() === null || $ilias_object instanceof ilObjOrgUnit || $ilias_object instanceof ilObjRole
            || $ilias_object instanceof ilObjUser
        ) {
            $ilias_object->delete();
        } else {
            if (!$object->isInTrash()) {
                ilRepUtil::deleteObjects($object->getParentRefId(), [$object->getRefId()]);
            }
        }

        return ObjectIdDto::new(
            $object->getId(),
            $object->getImportId(),
            $object->getRefId()
        );
    }
}
