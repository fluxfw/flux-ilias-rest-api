<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\Port\CategoryService;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;

class Api
{

    private ?CategoryService $category = null;
    private ?CourseService $course = null;
    private ?CourseMemberService $course_member = null;
    private ?ObjectService $object = null;
    private ?ScormLearningModuleService $scorm_learning_module = null;
    private ?UserService $user = null;


    public static function new() : /*static*/ self
    {
        $api = new static();

        return $api;
    }


    public function addCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
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


    public function createCourseToId(int $parent_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->createCourseToId(
                $parent_id,
                $diff
            );
    }


    public function createCourseToImportId(string $parent_import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->createCourseToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCourseToRefId(int $parent_ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->createCourseToRefId(
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


    public function createScormLearningModuleToId(int $parent_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->createScormLearningModuleToId(
                $parent_id,
                $diff
            );
    }


    public function createScormLearningModuleToImportId(string $parent_import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->createScormLearningModuleToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createScormLearningModuleToRefId(int $parent_ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->createScormLearningModuleToRefId(
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


    public function getCategories() : array
    {
        return $this->getCategory()
            ->getCategories();
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


    public function getCourseById(int $id) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseById(
                $id
            );
    }


    public function getCourseByImportId(string $import_id) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseByImportId(
                $import_id
            );
    }


    public function getCourseByRefId(int $ref_id) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseByRefId(
                $ref_id
            );
    }


    public function getCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function getCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function getCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function getCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function getCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function getCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberDto
    {
        return $this->getCourseMember()
            ->getCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function getCourseMembersById(int $id) : ?array
    {
        return $this->getCourseMember()
            ->getCourseMembersById(
                $id
            );
    }


    public function getCourseMembersByImportId(string $import_id) : ?array
    {
        return $this->getCourseMember()
            ->getCourseMembersByImportId(
                $import_id
            );
    }


    public function getCourseMembersByRefId(int $ref_id) : ?array
    {
        return $this->getCourseMember()
            ->getCourseMembersByRefId(
                $ref_id
            );
    }


    public function getCourses(bool $container_settings = false) : array
    {
        return $this->getCourse()
            ->getCourses(
                $container_settings
            );
    }


    public function getCurrentApiUser() : ?UserDto
    {
        global $DIC;

        return $this->getUserById(
            $DIC->user()->getId()
        );
    }


    public function getCurrentWebUser(?string $session_id) : ?UserDto
    {
        return $this->getUser()
            ->getCurrentWebUser(
                $session_id
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


    public function getScormLearningModuleById(int $id) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleById(
                $id
            );
    }


    public function getScormLearningModuleByImportId(string $import_id) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleByImportId(
                $import_id
            );
    }


    public function getScormLearningModuleByRefId(int $ref_id) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleByRefId(
                $ref_id
            );
    }


    public function getScormLearningModules() : array
    {
        return $this->getScormLearningModule()
            ->getScormLearningModules();
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


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
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


    public function updateCourseById(int $id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->updateCourseById(
                $id,
                $diff
            );
    }


    public function updateCourseByImportId(string $import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->updateCourseByImportId(
                $import_id,
                $diff
            );
    }


    public function updateCourseByRefId(int $ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getCourse()
            ->updateCourseByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
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


    public function updateScormLearningModuleById(int $id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->updateScormLearningModuleById(
                $id,
                $diff
            );
    }


    public function updateScormLearningModuleByImportId(string $import_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->updateScormLearningModuleByImportId(
                $import_id,
                $diff
            );
    }


    public function updateScormLearningModuleByRefId(int $ref_id, ScormLearningModuleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->updateScormLearningModuleByRefId(
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


    public function uploadScormLearningModuleById(int $id, string $file) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->uploadScormLearningModuleById(
                $id,
                $file
            );
    }


    public function uploadScormLearningModuleByImportId(string $import_id, string $file) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->uploadScormLearningModuleByImportId(
                $import_id,
                $file
            );
    }


    public function uploadScormLearningModuleByRefId(int $ref_id, string $file) : ?ObjectIdDto
    {
        return $this->getScormLearningModule()
            ->uploadScormLearningModuleByRefId(
                $ref_id,
                $file
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


    private function getCourse() : CourseService
    {
        global $DIC;

        $this->course ??= CourseService::new(
            $DIC->database(),
            $this->getObject()
        );

        return $this->course;
    }


    private function getCourseMember() : CourseMemberService
    {
        global $DIC;

        $this->course_member ??= CourseMemberService::new(
            $DIC->database(),
            $this->getCourse(),
            $this->getUser()
        );

        return $this->course_member;
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


    private function getScormLearningModule() : ScormLearningModuleService
    {
        global $DIC;

        $this->scorm_learning_module ??= ScormLearningModuleService::new(
            $DIC->database(),
            $this->getObject()
        );

        return $this->scorm_learning_module;
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
