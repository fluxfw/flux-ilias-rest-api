<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilObjectDefinition;
use ilObjUser;
use ilTree;
use LogicException;

class CloneObjectCommand
{

    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilTree $ilias_tree,
        private readonly ilObjUser $ilias_user,
        private readonly ilObjectDefinition $ilias_object_definition
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilTree $ilias_tree,
        ilObjUser $ilias_user,
        ilObjectDefinition $ilias_object_definition
    ) : static {
        return new static(
            $object_service,
            $ilias_tree,
            $ilias_user,
            $ilias_object_definition
        );
    }


    public function cloneObjectByIdToId(int $id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByIdToImportId(int $id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByIdToRefId(int $id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectById(
                $id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByImportId(
                $import_id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object_service->getObjectByRefId(
                $ref_id,
                false
            ),
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $link,
            $prefer_link
        );
    }


    private function cloneObject(?ObjectDto $object, ?ObjectDto $parent_object, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        if ($object === null || $parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        if ($object->id === $parent_object->id) {
            throw new LogicException("Can't clone to its self");
        }

        $ilias_object = $this->getIliasObject(
            $object->id,
            $object->ref_id
        );
        if ($ilias_object === null) {
            return null;
        }

        $new_ilias_object = $this->cloneIliasObject(
            $ilias_object,
            $parent_object,
            $link,
            $prefer_link
        );
        if ($new_ilias_object === null) {
            return null;
        }

        return ObjectIdDto::new(
            $new_ilias_object->getId() ?: null,
            $new_ilias_object->getImportId() ?: null,
            $new_ilias_object->getRefId() ?: null
        );
    }
}
