<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Object\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\CloneObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\CreateObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\DeleteObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetChildrenCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetObjectsCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetPathCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\GetRootObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\LinkObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\MoveObjectCommand;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Command\UpdateObjectCommand;
use ilDBInterface;
use ilObjectDefinition;
use ilObjUser;
use ilTree;

class ObjectService
{

    private ilDBInterface $database;
    private ilObjUser $ilias_user;
    private ilObjectDefinition $object_definition;
    private ilTree $tree;


    public static function new(ilDBInterface $database, ilTree $tree, ilObjUser $ilias_user, ilObjectDefinition $object_definition) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->tree = $tree;
        $service->ilias_user = $ilias_user;
        $service->object_definition = $object_definition;

        return $service;
    }


    public function cloneObjectByIdToId(int $id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByIdToId(
                $id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByIdToImportId(int $id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByIdToImportId(
                $id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByIdToRefId(int $id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByIdToRefId(
                $id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByImportIdToId(
                $import_id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByImportIdToImportId(
                $import_id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByRefIdToId(
                $ref_id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->tree,
            $this->ilias_user,
            $this->object_definition
        )
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function createObjectToId(string $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToId(
                $type,
                $parent_id,
                $diff
            );
    }


    public function createObjectToImportId(string $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToImportId(
                $type,
                $parent_import_id,
                $diff
            );
    }


    public function createObjectToRefId(string $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this
        )
            ->createObjectToRefId(
                $type,
                $parent_ref_id,
                $diff
            );
    }


    public function deleteObjectById(int $id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectById(
                $id
            );
    }


    public function deleteObjectByImportId(string $import_id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByImportId(
                $import_id
            );
    }


    public function deleteObjectByRefId(int $ref_id) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByRefId(
                $ref_id
            );
    }


    public function getChildrenById(int $id, bool $ref_ids = false) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenById(
                $id,
                $ref_ids
            );
    }


    public function getChildrenByImportId(string $import_id, bool $ref_ids = false) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenByImportId(
                $import_id,
                $ref_ids
            );
    }


    public function getChildrenByRefId(int $ref_id, bool $ref_ids = false) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->database
        )
            ->getChildrenByRefId(
                $ref_id,
                $ref_ids
            );
    }


    public function getObjectById(int $id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectById(
                $id
            );
    }


    public function getObjectByImportId(string $import_id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectByImportId(
                $import_id
            );
    }


    public function getObjectByRefId(int $ref_id) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->database
        )
            ->getObjectByRefId(
                $ref_id
            );
    }


    public function getObjects(string $type, bool $ref_ids = false) : array
    {
        return GetObjectsCommand::new(
            $this->database
        )
            ->getObjects(
                $type,
                $ref_ids
            );
    }


    public function getPathById(int $id, bool $ref_ids = false) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->database,
            $this->tree
        )
            ->getPathById(
                $id,
                $ref_ids
            );
    }


    public function getPathByImportId(string $import_id, bool $ref_ids = false) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->database,
            $this->tree
        )
            ->getPathByImportId(
                $import_id,
                $ref_ids
            );
    }


    public function getPathByRefId(int $ref_id, bool $ref_ids = false) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->database,
            $this->tree
        )
            ->getPathByRefId(
                $ref_id,
                $ref_ids
            );
    }


    public function getRootObject() : ?ObjectDto
    {
        return GetRootObjectCommand::new(
            $this
        )
            ->getRootObject();
    }


    public function linkObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByIdToId(
                $id,
                $parent_id
            );
    }


    public function linkObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByIdToImportId(
                $id,
                $parent_import_id
            );
    }


    public function linkObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByIdToRefId(
                $id,
                $parent_ref_id
            );
    }


    public function linkObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByImportIdToId(
                $import_id,
                $parent_id
            );
    }


    public function linkObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByImportIdToImportId(
                $import_id,
                $parent_import_id
            );
    }


    public function linkObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id
            );
    }


    public function linkObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByRefIdToId(
                $ref_id,
                $parent_id
            );
    }


    public function linkObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id
            );
    }


    public function linkObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->object_definition
        )
            ->linkObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
            );
    }


    public function moveObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToId(
                $id,
                $parent_id
            );
    }


    public function moveObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToImportId(
                $id,
                $parent_import_id
            );
    }


    public function moveObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByIdToRefId(
                $id,
                $parent_ref_id
            );
    }


    public function moveObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToId(
                $import_id,
                $parent_id
            );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToImportId(
                $import_id,
                $parent_import_id
            );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id
            );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToId(
                $ref_id,
                $parent_id
            );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id
            );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return MoveObjectCommand::new(
            $this,
            $this->tree
        )
            ->moveObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
            );
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectById(
                $id,
                $diff
            );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectByImportId(
                $import_id,
                $diff
            );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this
        )
            ->updateObjectByRefId(
                $ref_id,
                $diff
            );
    }
}
