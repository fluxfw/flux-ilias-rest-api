<?php

namespace FluxIliasRestApi\Service\Object\Port;

use FluxIliasRestApi\Adapter\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Adapter\Permission\Permission;
use FluxIliasRestApi\Service\Object\Command\CloneObjectCommand;
use FluxIliasRestApi\Service\Object\Command\CreateObjectCommand;
use FluxIliasRestApi\Service\Object\Command\DeleteObjectCommand;
use FluxIliasRestApi\Service\Object\Command\GetChildrenCommand;
use FluxIliasRestApi\Service\Object\Command\GetObjectCommand;
use FluxIliasRestApi\Service\Object\Command\GetObjectsCommand;
use FluxIliasRestApi\Service\Object\Command\GetPathCommand;
use FluxIliasRestApi\Service\Object\Command\HasAccessByRefIdByUserIdCommand;
use FluxIliasRestApi\Service\Object\Command\HasAccessByRefIdsByUserIdCommand;
use FluxIliasRestApi\Service\Object\Command\LinkObjectCommand;
use FluxIliasRestApi\Service\Object\Command\MoveObjectCommand;
use FluxIliasRestApi\Service\Object\Command\UpdateObjectCommand;
use ilAccessHandler;
use ilDBInterface;
use ilObjectDefinition;
use ilObjUser;
use ilTree;

class ObjectService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ilTree $ilias_tree,
        private readonly ilObjUser $ilias_user,
        private readonly ilObjectDefinition $ilias_object_definition,
        private readonly ilAccessHandler $ilias_access
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ilTree $ilias_tree,
        ilObjUser $ilias_user,
        ilObjectDefinition $ilias_object_definition,
        ilAccessHandler $ilias_access
    ) : static {
        return new static(
            $ilias_database,
            $ilias_tree,
            $ilias_user,
            $ilias_object_definition,
            $ilias_access
        );
    }


    public function cloneObjectByIdToId(int $id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return CloneObjectCommand::new(
            $this,
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
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
            $this->ilias_tree,
            $this->ilias_user,
            $this->ilias_object_definition
        )
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function createObjectToId(ObjectType $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->createObjectToId(
                $type,
                $parent_id,
                $diff
            );
    }


    public function createObjectToImportId(ObjectType $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->createObjectToImportId(
                $type,
                $parent_import_id,
                $diff
            );
    }


    public function createObjectToRefId(ObjectType $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return CreateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->createObjectToRefId(
                $type,
                $parent_ref_id,
                $diff
            );
    }


    public function deleteObjectById(int $id, bool $force = false) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectById(
                $id,
                $force
            );
    }


    public function deleteObjectByImportId(string $import_id, bool $force = false) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByImportId(
                $import_id,
                $force
            );
    }


    public function deleteObjectByRefId(int $ref_id, bool $force = false) : ?ObjectIdDto
    {
        return DeleteObjectCommand::new(
            $this
        )
            ->deleteObjectByRefId(
                $ref_id,
                $force
            );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenById(int $id, ?array $types = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->ilias_database
        )
            ->getChildrenById(
                $id,
                $types,
                $title,
                $ref_ids,
                $in_trash
            );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenByImportId(string $import_id, ?array $types = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->ilias_database
        )
            ->getChildrenByImportId(
                $import_id,
                $types,
                $title,
                $ref_ids,
                $in_trash
            );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]|null
     */
    public function getChildrenByRefId(int $ref_id, ?array $types = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetChildrenCommand::new(
            $this,
            $this->ilias_database
        )
            ->getChildrenByRefId(
                $ref_id,
                $types,
                $title,
                $ref_ids,
                $in_trash
            );
    }


    public function getObjectById(int $id, ?bool $in_trash = null) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->ilias_database
        )
            ->getObjectById(
                $id,
                $in_trash
            );
    }


    public function getObjectByImportId(string $import_id, ?bool $in_trash = null) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->ilias_database
        )
            ->getObjectByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?ObjectDto
    {
        return GetObjectCommand::new(
            $this->ilias_database
        )
            ->getObjectByRefId(
                $ref_id,
                $in_trash
            );
    }


    /**
     * @param ObjectType[]|null $types
     * @return ObjectDto[]
     */
    public function getObjects(?array $types = null, ?string $title = null, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        return GetObjectsCommand::new(
            $this->ilias_database
        )
            ->getObjects(
                $types,
                $title,
                $ref_ids,
                $in_trash
            );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getPathById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->ilias_database,
            $this->ilias_tree
        )
            ->getPathById(
                $id,
                $ref_ids,
                $in_trash
            );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getPathByImportId(string $import_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->ilias_database,
            $this->ilias_tree
        )
            ->getPathByImportId(
                $import_id,
                $ref_ids,
                $in_trash
            );
    }


    /**
     * @return ObjectDto[]|null
     */
    public function getPathByRefId(int $ref_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return GetPathCommand::new(
            $this,
            $this->ilias_database,
            $this->ilias_tree
        )
            ->getPathByRefId(
                $ref_id,
                $ref_ids,
                $in_trash
            );
    }


    public function hasAccessByRefIdByUserId(int $ref_id, int $user_id, Permission $permission) : bool
    {
        return HasAccessByRefIdByUserIdCommand::new(
            $this->ilias_access
        )
            ->hasAccessByRefIdByUserId(
                $ref_id,
                $user_id,
                $permission
            );
    }


    /**
     * @param int[] $ref_ids
     * @return int[]
     */
    public function hasAccessByRefIdsByUserId(array $ref_ids, int $user_id, Permission $permission) : array
    {
        return HasAccessByRefIdsByUserIdCommand::new(
            $this
        )
            ->hasAccessByRefIdsByUserId(
                $ref_ids,
                $user_id,
                $permission
            );
    }


    public function linkObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return LinkObjectCommand::new(
            $this,
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_object_definition
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
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
            $this->ilias_tree
        )
            ->moveObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
            );
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateObjectById(
                $id,
                $diff
            );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateObjectByImportId(
                $import_id,
                $diff
            );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateObjectCommand::new(
            $this,
            $this->ilias_database
        )
            ->updateObjectByRefId(
                $ref_id,
                $diff
            );
    }
}
