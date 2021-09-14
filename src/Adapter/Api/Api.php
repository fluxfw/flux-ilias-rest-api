<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\Port\CategoryService;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;

class Api
{

    private ?CategoryService $category = null;
    private ?ObjectService $object = null;
    private ?UserService $user = null;


    public static function new() : /*static*/ self
    {
        $api = new static();

        return $api;
    }


    public function cloneObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToId(
                $id,
                $new_parent_id
            );
    }


    public function cloneObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToImportId(
                $id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToRefId(
                $id,
                $new_parent_ref_id
            );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToId(
                $import_id,
                $new_parent_id
            );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToImportId(
                $import_id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToRefId(
                $import_id,
                $new_parent_ref_id
            );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToId(
                $ref_id,
                $new_parent_id
            );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToImportId(
                $ref_id,
                $new_parent_import_id
            );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $new_parent_ref_id
            );
    }


    public function createCategoryToId(int $parent_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->createCategoryToId(
                $parent_id,
                $diff
            );
    }


    public function createCategoryToImportId(string $parent_import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->createCategoryToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCategoryToRefId(int $parent_ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->createCategoryToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function createObjectToId(string $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->createObjectToId(
                $type,
                $parent_id,
                $diff
            );
    }


    public function createObjectToImportId(string $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->createObjectToImportId(
                $type,
                $parent_import_id,
                $diff
            );
    }


    public function createObjectToRefId(string $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->createObjectToRefId(
                $type,
                $parent_ref_id,
                $diff
            );
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        return $this->getUser()
            ->createUser(
                $diff
            );
    }


    public function deleteObjectById(int $id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectById(
                $id
            );
    }


    public function deleteObjectByImportId(string $import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectByImportId(
                $import_id
            );
    }


    public function deleteObjectByRefId(int $ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectByRefId(
                $ref_id
            );
    }


    public function deleteUserById(int $id) : ?UserIdDto
    {
        return $this->getUser()
            ->deleteUserById(
                $id
            );
    }


    public function deleteUserByImportId(string $import_id) : ?UserIdDto
    {
        return $this->getUser()
            ->deleteUserByImportId(
                $import_id
            );
    }


    public function getAvatarPathById(int $id) : ?string
    {
        return $this->getUser()
            ->getAvatarPathById(
                $id
            );
    }


    public function getAvatarPathByImportId(string $import_id) : ?string
    {
        return $this->getUser()
            ->getAvatarPathByImportId(
                $import_id
            );
    }


    public function getCategoryById(int $id) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryById(
                $id
            );
    }


    public function getCategoryByImportId(string $import_id) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryByImportId(
                $import_id
            );
    }


    public function getCategoryByRefId(int $ref_id) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryByRefId(
                $ref_id
            );
    }


    public function getChildrenById(int $id) : ?array
    {
        return $this->getObject()
            ->getChildrenById(
                $id
            );
    }


    public function getChildrenByImportId(string $import_id) : ?array
    {
        return $this->getObject()
            ->getChildrenByImportId(
                $import_id
            );
    }


    public function getChildrenByRefId(int $ref_id) : ?array
    {
        return $this->getObject()
            ->getChildrenByRefId(
                $ref_id
            );
    }


    public function getObjectById(int $id) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectById(
                $id
            );
    }


    public function getObjectByImportId(string $import_id) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectByImportId(
                $import_id
            );
    }


    public function getObjectByRefId(int $ref_id) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectByRefId(
                $ref_id
            );
    }


    public function getObjects(string $type) : array
    {
        return $this->getObject()
            ->getObjects(
                $type
            );
    }


    public function getUserById(int $id) : ?UserDto
    {
        return $this->getUser()
            ->getUserById(
                $id
            );
    }


    public function getUserByImportId(string $import_id) : ?UserDto
    {
        return $this->getUser()
            ->getUserByImportId(
                $import_id
            );
    }


    public function getUsers(bool $access_limited_object_ids = false, bool $multi_fields = false, bool $preferences = false, bool $user_defined_fields = false) : array
    {
        return $this->getUser()
            ->getUsers(
                $access_limited_object_ids,
                $multi_fields,
                $preferences,
                $user_defined_fields
            );
    }


    public function moveObjectByIdToId(int $id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToId(
                $id,
                $new_parent_id
            );
    }


    public function moveObjectByIdToImportId(int $id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToImportId(
                $id,
                $new_parent_import_id
            );
    }


    public function moveObjectByIdToRefId(int $id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToRefId(
                $id,
                $new_parent_ref_id
            );
    }


    public function moveObjectByImportIdToId(string $import_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToId(
                $import_id,
                $new_parent_id
            );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToImportId(
                $import_id,
                $new_parent_import_id
            );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToRefId(
                $import_id,
                $new_parent_ref_id
            );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $new_parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToId(
                $ref_id,
                $new_parent_id
            );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $new_parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToImportId(
                $ref_id,
                $new_parent_import_id
            );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $new_parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToRefId(
                $ref_id,
                $new_parent_ref_id
            );
    }


    public function updateAvatarById(int $id, ?string $file) : ?UserIdDto
    {
        return $this->getUser()
            ->updateAvatarById(
                $id,
                $file
            );
    }


    public function updateAvatarByImportId(string $import_id, ?string $file) : ?UserIdDto
    {
        return $this->getUser()
            ->updateAvatarByImportId(
                $import_id,
                $file
            );
    }


    public function updateCategoryById(int $id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->updateCategoryById(
                $id,
                $diff
            );
    }


    public function updateCategoryByImportId(string $import_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->updateCategoryByImportId(
                $import_id,
                $diff
            );
    }


    public function updateCategoryByRefId(int $ref_id, CategoryDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCategory()
            ->updateCategoryByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateObjectById(int $id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->updateObjectById(
                $id,
                $diff
            );
    }


    public function updateObjectByImportId(string $import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->updateObjectByImportId(
                $import_id,
                $diff
            );
    }


    public function updateObjectByRefId(int $ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->updateObjectByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateUserById(int $id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->getUser()
            ->updateUserById(
                $id,
                $diff
            );
    }


    public function updateUserByImportId(string $import_id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->getUser()
            ->updateUserByImportId(
                $import_id,
                $diff
            );
    }


    private function getCategory() : CategoryService
    {
        global $DIC;

        $this->category ??= CategoryService::new(
            $DIC->database(),
            $this->getObject()
        );

        return $this->category;
    }


    private function getObject() : ObjectService
    {
        global $DIC;

        $this->object ??= ObjectService::new(
            $DIC->database(),
            $DIC->repositoryTree()
        );

        return $this->object;
    }


    private function getUser() : UserService
    {
        global $DIC;

        $this->user ??= UserService::new(
            $DIC->database(),
            $DIC->rbac(),
            $this->getObject()
        );

        return $this->user;
    }
}
