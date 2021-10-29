<?php

namespace FluxIliasRestApi\Channel\Object\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilObjectDefinition;
use ilObjUser;
use ilTree;
use LogicException;

class CloneObjectCommand
{

    use ObjectQuery;

    private ilObjUser $ilias_user;
    private ObjectService $object;
    private ilObjectDefinition $object_definition;
    private ilTree $tree;


    public static function new(ObjectService $object, ilTree $tree, ilObjUser $ilias_user, ilObjectDefinition $object_definition) : /*static*/ self
    {
        $command = new static();

        $command->object = $object;
        $command->tree = $tree;
        $command->ilias_user = $ilias_user;
        $command->object_definition = $object_definition;

        return $command;
    }


    public function cloneObjectByIdToId(int $id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectById(
                $parent_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByIdToImportId(int $id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByIdToRefId(int $id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectById(
                $id
            ),
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectById(
                $parent_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByImportId(
                $import_id
            ),
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectById(
                $parent_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByImportId(
                $parent_import_id
            ),
            $link,
            $prefer_link
        );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->cloneObject(
            $this->object->getObjectByRefId(
                $ref_id
            ),
            $this->object->getObjectByRefId(
                $parent_ref_id
            ),
            $link,
            $prefer_link
        );
    }


    private function cloneObject(?ObjectDto $object, ?ObjectDto $parent_object, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        if ($object === null || $parent_object === null || $parent_object->getRefId() === null) {
            return null;
        }

        if ($object->getId() === $parent_object->getId()) {
            throw new LogicException("Can't clone to its self");
        }

        $ilias_object = $this->getIliasObject(
            $object->getId(),
            $object->getRefId()
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
