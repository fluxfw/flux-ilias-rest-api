<?php

namespace FluxIliasRestApi\Service\Object\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilObjectDefinition;
use LogicException;

class LinkObjectCommand
{

    use ObjectQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilObjectDefinition $ilias_object_definition
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilObjectDefinition $ilias_object_definition
    ) : static {
        return new static(
            $object_service,
            $ilias_object_definition
        );
    }


    public function linkObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    public function linkObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->linkObject(
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


    private function linkObject(?ObjectDto $object, ?ObjectDto $parent_object) : ?ObjectIdDto
    {
        if ($object === null || $parent_object === null || $object->ref_id === null || $parent_object->ref_id === null) {
            return null;
        }

        if ($object->id === $parent_object->id) {
            throw new LogicException("Can't link to its self");
        }

        $ilias_object = $this->getIliasObject(
            $object->id,
            $object->ref_id
        );
        if ($ilias_object === null) {
            return null;
        }

        if (!$this->ilias_object_definition->allowLink($ilias_object->getType())) {
            throw new LogicException("Can't link object type " . $ilias_object->getType());
        }

        $ilias_object->createReference();
        $ilias_object->putInTree($parent_object->ref_id);
        $ilias_object->setPermissions($parent_object->ref_id);

        return ObjectIdDto::new(
            $object->id,
            $object->import_id,
            $ilias_object->getRefId() ?: null
        );
    }
}
