<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilObjOrgUnit;
use ilObjRole;
use ilObjUser;
use ilRepUtil;

class DeleteObjectCommand
{

    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ObjectService $object_service
    ) : static {
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
            $object->id,
            $object->ref_id
        );
        if ($ilias_object === null) {
            return null;
        }

        if ($force || $object->ref_id === null || $object->parent_ref_id === null || $ilias_object instanceof ilObjOrgUnit || $ilias_object instanceof ilObjRole
            || $ilias_object instanceof ilObjUser
        ) {
            $ilias_object->delete();
        } else {
            if (!$object->in_trash) {
                ilRepUtil::deleteObjects($object->parent_ref_id, [$object->ref_id]);
            }
        }

        return ObjectIdDto::new(
            $object->id,
            $object->import_id,
            $object->ref_id
        );
    }
}
