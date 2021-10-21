<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\File\FileDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\File\FileDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserFavourite\UserFavouriteDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use Fluxlabs\FluxIliasRestApi\Channel\Category\Port\CategoryService;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use Fluxlabs\FluxIliasRestApi\Channel\File\Port\FileService;
use Fluxlabs\FluxIliasRestApi\Channel\Group\Port\GroupService;
use Fluxlabs\FluxIliasRestApi\Channel\GroupMember\Port\GroupMemberService;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress\Port\ObjectLearningProgressService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use Fluxlabs\FluxIliasRestApi\Channel\Role\Port\RoleService;
use Fluxlabs\FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Port\UserFavouriteService;
use Fluxlabs\FluxIliasRestApi\Channel\UserMail\Port\UserMailService;
use Fluxlabs\FluxIliasRestApi\Channel\UserRole\Port\UserRoleService;
use ilFavouritesDBRepository;

class Api
{

    private ?CategoryService $category = null;
    private ?CourseService $course = null;
    private ?CourseMemberService $course_member = null;
    private ?FileService $file = null;
    private ?GroupService $group = null;
    private ?GroupMemberService $group_member = null;
    private ?ObjectService $object = null;
    private ?ObjectLearningProgressService $object_learning_progress = null;
    private ?OrganisationalUnitService $organisational_unit = null;
    private ?OrganisationalUnitPositionService $organisational_unit_position = null;
    private ?OrganisationalUnitStaffService $organisational_unit_staff = null;
    private ?RoleService $role = null;
    private ?ScormLearningModuleService $scorm_learning_module = null;
    private ?UserService $user = null;
    private ?UserFavouriteService $user_favourite = null;
    private ?UserMailService $user_mail = null;
    private ?UserRoleService $user_role = null;


    public static function new() : /*static*/ self
    {
        $api = new static();

        return $api;
    }


    public function addCourseMemberByIdByUserId(int $id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->addCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    public function addGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function addGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function addGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function addGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->addGroupMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function addOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->addOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }


    public function addUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function addUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function addUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function addUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function addUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function addUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->addUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }


    public function addUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->addUserRoleByIdByRoleId(
                $id,
                $role_id
            );
    }


    public function addUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->addUserRoleByIdByRoleImportId(
                $id,
                $role_import_id
            );
    }


    public function addUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->addUserRoleByImportIdByRoleId(
                $import_id,
                $role_id
            );
    }


    public function addUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->addUserRoleByImportIdByRoleImportId(
                $import_id,
                $role_import_id
            );
    }


    public function cloneObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToId(
                $id,
                $parent_id
            );
    }


    public function cloneObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToImportId(
                $id,
                $parent_import_id
            );
    }


    public function cloneObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToRefId(
                $id,
                $parent_ref_id
            );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToId(
                $import_id,
                $parent_id
            );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToImportId(
                $import_id,
                $parent_import_id
            );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id
            );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToId(
                $ref_id,
                $parent_id
            );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id
            );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
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


    public function createFileToId(int $parent_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->createFileToId(
                $parent_id,
                $diff
            );
    }


    public function createFileToImportId(string $parent_import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->createFileToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createFileToRefId(int $parent_ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->createFileToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function createGroupToId(int $parent_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->createGroupToId(
                $parent_id,
                $diff
            );
    }


    public function createGroupToImportId(string $parent_import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->createGroupToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createGroupToRefId(int $parent_ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->createGroupToRefId(
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


    public function createOrganisationalUnitPosition(OrganisationalUnitPositionDiffDto $diff) : OrganisationalUnitPositionIdDto
    {
        return $this->getOrganisationalUnitPosition()
            ->createOrganisationalUnitPosition(
                $diff
            );
    }


    public function createOrganisationalUnitToExternalId(string $parent_external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->createOrganisationalUnitToExternalId(
                $parent_external_id,
                $diff
            );
    }


    public function createOrganisationalUnitToId(int $parent_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->createOrganisationalUnitToId(
                $parent_id,
                $diff
            );
    }


    public function createOrganisationalUnitToRefId(int $parent_ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->createOrganisationalUnitToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function createRoleToId(int $parent_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToId(
                $parent_id,
                $diff
            );
    }


    public function createRoleToImportId(string $parent_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createRoleToRefId(int $parent_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToRefId(
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


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return $this->getOrganisationalUnitPosition()
            ->deleteOrganisationalUnitPositionById(
                $id
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


    public function getChildrenById(int $id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getChildrenById(
                $id,
                $ref_ids
            );
    }


    public function getChildrenByImportId(string $import_id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getChildrenByImportId(
                $import_id,
                $ref_ids
            );
    }


    public function getChildrenByRefId(int $ref_id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getChildrenByRefId(
                $ref_id,
                $ref_ids
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


    public function getCourseMembers(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?string $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return $this->getCourseMember()
            ->getCourseMembers(
                $course_id,
                $course_import_id,
                $course_ref_id,
                $user_id,
                $user_import_id,
                $member_role,
                $tutor_role,
                $administrator_role,
                $learning_progress,
                $passed,
                $access_refused,
                $tutorial_support,
                $notification
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


    public function getFileById(int $id) : ?FileDto
    {
        return $this->getFile()
            ->getFileById(
                $id
            );
    }


    public function getFileByImportId(string $import_id) : ?FileDto
    {
        return $this->getFile()
            ->getFileByImportId(
                $import_id
            );
    }


    public function getFileByRefId(int $ref_id) : ?FileDto
    {
        return $this->getFile()
            ->getFileByRefId(
                $ref_id
            );
    }


    public function getFiles() : array
    {
        return $this->getFile()
            ->getFiles();
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return $this->getRole()
            ->getGlobalRoleObject();
    }


    public function getGroupById(int $id) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupById(
                $id
            );
    }


    public function getGroupByImportId(string $import_id) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupByImportId(
                $import_id
            );
    }


    public function getGroupByRefId(int $ref_id) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupByRefId(
                $ref_id
            );
    }


    public function getGroupMembers(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?string $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return $this->getGroupMember()
            ->getGroupMembers(
                $group_id,
                $group_import_id,
                $group_ref_id,
                $user_id,
                $user_import_id,
                $member_role,
                $administrator_role,
                $learning_progress,
                $tutorial_support,
                $notification
            );
    }


    public function getGroups() : array
    {
        return $this->getGroup()
            ->getGroups();
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


    public function getObjectLearningProgress(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?string $learning_progress = null
    ) : array {
        return $this->getObjectLearningProgress_()
            ->getObjectLearningProgress(
                $object_id,
                $object_import_id,
                $object_ref_id,
                $user_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function getObjects(string $type, bool $ref_ids = false) : array
    {
        return $this->getObject()
            ->getObjects(
                $type,
                $ref_ids
            );
    }


    public function getOrganisationalUnitByExternalId(string $external_id) : ?OrganisationalUnitDto
    {
        return $this->getOrganisationalUnit()
            ->getOrganisationalUnitByExternalId(
                $external_id
            );
    }


    public function getOrganisationalUnitById(int $id) : ?OrganisationalUnitDto
    {
        return $this->getOrganisationalUnit()
            ->getOrganisationalUnitById(
                $id
            );
    }


    public function getOrganisationalUnitByRefId(int $ref_id) : ?OrganisationalUnitDto
    {
        return $this->getOrganisationalUnit()
            ->getOrganisationalUnitByRefId(
                $ref_id
            );
    }


    public function getOrganisationalUnitPositionByCoreIdentifier(string $core_identifier) : ?OrganisationalUnitPositionDto
    {
        return $this->getOrganisationalUnitPosition()
            ->getOrganisationalUnitPositionByCoreIdentifier(
                $core_identifier
            );
    }


    public function getOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionDto
    {
        return $this->getOrganisationalUnitPosition()
            ->getOrganisationalUnitPositionById(
                $id
            );
    }


    public function getOrganisationalUnitPositions(bool $authorities = false) : array
    {
        return $this->getOrganisationalUnitPosition()
            ->getOrganisationalUnitPositions(
                $authorities
            );
    }


    public function getOrganisationalUnitRoot() : ?OrganisationalUnitDto
    {
        return $this->getOrganisationalUnit()
            ->getOrganisationalUnitRoot();
    }


    public function getOrganisationalUnitStaff(
        ?int $organisational_unit_id = null,
        ?string $organisational_unit_external_id = null,
        ?int $organisational_unit_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $position_id = null
    ) : array {
        return $this->getOrganisationalUnitStaff_()
            ->getOrganisationalUnitStaff(
                $organisational_unit_id,
                $organisational_unit_external_id,
                $organisational_unit_ref_id,
                $user_id,
                $user_import_id,
                $position_id
            );
    }


    public function getOrganisationalUnits() : array
    {
        return $this->getOrganisationalUnit()
            ->getOrganisationalUnits();
    }


    public function getPathById(int $id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getPathById(
                $id,
                $ref_ids
            );
    }


    public function getPathByImportId(string $import_id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getPathByImportId(
                $import_id,
                $ref_ids
            );
    }


    public function getPathByRefId(int $ref_id, bool $ref_ids = false) : ?array
    {
        return $this->getObject()
            ->getPathByRefId(
                $ref_id,
                $ref_ids
            );
    }


    public function getRoleById(int $id) : ?RoleDto
    {
        return $this->getRole()
            ->getRoleById(
                $id
            );
    }


    public function getRoleByImportId(string $import_id) : ?RoleDto
    {
        return $this->getRole()
            ->getRoleByImportId(
                $import_id
            );
    }


    public function getRoles() : array
    {
        return $this->getRole()
            ->getRoles();
    }


    public function getRootObject() : ?ObjectDto
    {
        return $this->getObject()
            ->getRootObject();
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


    public function getUnreadMailsCountById(int $id) : ?int
    {
        return $this->getUserMail()
            ->getUnreadMailsCountById(
                $id
            );
    }


    public function getUnreadMailsCountByImportId(string $import_id) : ?int
    {
        return $this->getUserMail()
            ->getUnreadMailsCountByImportId(
                $import_id
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


    public function getUserFavourites(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : array
    {
        return $this->getUserFavourite()
            ->getUserFavourites(
                $user_id,
                $user_import_id,
                $object_id,
                $object_import_id,
                $object_ref_id
            );
    }


    public function getUserRoles(?int $user_id = null, ?string $user_import_id = null, ?int $role_id = null, ?string $role_import_id = null) : array
    {
        return $this->getUserRole()
            ->getUserRoles(
                $user_id,
                $user_import_id,
                $role_id,
                $role_import_id
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


    public function linkObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByIdToId(
                $id,
                $parent_id
            );
    }


    public function linkObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByIdToImportId(
                $id,
                $parent_import_id
            );
    }


    public function linkObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByIdToRefId(
                $id,
                $parent_ref_id
            );
    }


    public function linkObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByImportIdToId(
                $import_id,
                $parent_id
            );
    }


    public function linkObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByImportIdToImportId(
                $import_id,
                $parent_import_id
            );
    }


    public function linkObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id
            );
    }


    public function linkObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByRefIdToId(
                $ref_id,
                $parent_id
            );
    }


    public function linkObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id
            );
    }


    public function linkObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->linkObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
            );
    }


    public function moveObjectByIdToId(int $id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToId(
                $id,
                $parent_id
            );
    }


    public function moveObjectByIdToImportId(int $id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToImportId(
                $id,
                $parent_import_id
            );
    }


    public function moveObjectByIdToRefId(int $id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByIdToRefId(
                $id,
                $parent_ref_id
            );
    }


    public function moveObjectByImportIdToId(string $import_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToId(
                $import_id,
                $parent_id
            );
    }


    public function moveObjectByImportIdToImportId(string $import_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToImportId(
                $import_id,
                $parent_import_id
            );
    }


    public function moveObjectByImportIdToRefId(string $import_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id
            );
    }


    public function moveObjectByRefIdToId(int $ref_id, int $parent_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToId(
                $ref_id,
                $parent_id
            );
    }


    public function moveObjectByRefIdToImportId(int $ref_id, string $parent_import_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id
            );
    }


    public function moveObjectByRefIdToRefId(int $ref_id, int $parent_ref_id) : ?ObjectIdDto
    {
        return $this->getObject()
            ->moveObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id
            );
    }


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->removeCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function removeGroupMemberByIdByUserId(int $id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeGroupMemberByIdByUserImportId(int $id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeGroupMemberByImportIdByUserId(string $import_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeGroupMemberByRefIdByUserId(int $ref_id, int $user_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->removeGroupMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserId(string $external_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByExternalIdByUserId(
                $external_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByExternalIdByUserImportId(string $external_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByExternalIdByUserImportId(
                $external_id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserId(int $id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByIdByUserId(
                $id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByIdByUserImportId(int $id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByIdByUserImportId(
                $id,
                $user_import_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserId(int $ref_id, int $user_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByRefIdByUserId(
                $ref_id,
                $user_id,
                $position_id
            );
    }


    public function removeOrganisationalUnitStaffByRefIdByUserImportId(int $ref_id, string $user_import_id, int $position_id) : ?OrganisationalUnitStaffDto
    {
        return $this->getOrganisationalUnitStaff_()
            ->removeOrganisationalUnitStaffByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $position_id
            );
    }


    public function removeUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function removeUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->getUserFavourite()
            ->removeUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }


    public function removeUserRoleByIdByRoleId(int $id, int $role_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->removeUserRoleByIdByRoleId(
                $id,
                $role_id
            );
    }


    public function removeUserRoleByIdByRoleImportId(int $id, string $role_import_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->removeUserRoleByIdByRoleImportId(
                $id,
                $role_import_id
            );
    }


    public function removeUserRoleByImportIdByRoleId(string $import_id, int $role_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->removeUserRoleByImportIdByRoleId(
                $import_id,
                $role_id
            );
    }


    public function removeUserRoleByImportIdByRoleImportId(string $import_id, string $role_import_id) : ?UserRoleDto
    {
        return $this->getUserRole()
            ->removeUserRoleByImportIdByRoleImportId(
                $import_id,
                $role_import_id
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


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->getCourseMember()
            ->updateCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    public function updateFileById(int $id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->updateFileById(
                $id,
                $diff
            );
    }


    public function updateFileByImportId(string $import_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->updateFileByImportId(
                $import_id,
                $diff
            );
    }


    public function updateFileByRefId(int $ref_id, FileDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getFile()
            ->updateFileByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateGroupById(int $id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->updateGroupById(
                $id,
                $diff
            );
    }


    public function updateGroupByImportId(string $import_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->updateGroupByImportId(
                $import_id,
                $diff
            );
    }


    public function updateGroupByRefId(int $ref_id, GroupDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getGroup()
            ->updateGroupByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateGroupMemberByIdByUserId(int $id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByIdByUserImportId(int $id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function updateGroupMemberByImportIdByUserId(string $import_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByImportIdByUserImportId(string $import_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function updateGroupMemberByRefIdByUserId(int $ref_id, int $user_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function updateGroupMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, GroupMemberDiffDto $diff) : ?GroupMemberIdDto
    {
        return $this->getGroupMember()
            ->updateGroupMemberByRefIdByUserImportId(
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


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByIdByUserId(
                $id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByIdByUserImportId(
                $id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByImportIdByUserId(
                $import_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByRefIdByUserId(
                $ref_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, string $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateOrganisationalUnitByExternalId(string $external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->updateOrganisationalUnitByExternalId(
                $external_id,
                $diff
            );
    }


    public function updateOrganisationalUnitById(int $id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->updateOrganisationalUnitById(
                $id,
                $diff
            );
    }


    public function updateOrganisationalUnitByRefId(int $ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->getOrganisationalUnit()
            ->updateOrganisationalUnitByRefId(
                $ref_id,
                $diff
            );
    }


    public function updateOrganisationalUnitPositionById(int $id, OrganisationalUnitPositionDiffDto $diff) : ?OrganisationalUnitPositionIdDto
    {
        return $this->getOrganisationalUnitPosition()
            ->updateOrganisationalUnitPositionById(
                $id,
                $diff
            );
    }


    public function updateRoleById(int $id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->updateRoleById(
                $id,
                $diff
            );
    }


    public function updateRoleByImportId(string $import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->updateRoleByImportId(
                $import_id,
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


    public function uploadFileById(int $id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->getFile()
            ->uploadFileById(
                $id,
                $title,
                $replace
            );
    }


    public function uploadFileByImportId(string $import_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->getFile()
            ->uploadFileByImportId(
                $import_id,
                $title,
                $replace
            );
    }


    public function uploadFileByRefId(int $ref_id, ?string $title = null, bool $replace = false) : ?ObjectIdDto
    {
        return $this->getFile()
            ->uploadFileByRefId(
                $ref_id,
                $title,
                $replace
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


    private function getFile() : FileService
    {
        global $DIC;

        $this->file ??= FileService::new(
            $DIC->database(),
            $DIC->upload(),
            $this->getObject()
        );

        return $this->file;
    }


    private function getGroup() : GroupService
    {
        global $DIC;

        $this->group ??= GroupService::new(
            $DIC->database(),
            $this->getObject()
        );

        return $this->group;
    }


    private function getGroupMember() : GroupMemberService
    {
        global $DIC;

        $this->group_member ??= GroupMemberService::new(
            $DIC->database(),
            $this->getGroup(),
            $this->getUser()
        );

        return $this->group_member;
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


    private function getObjectLearningProgress_() : ObjectLearningProgressService
    {
        global $DIC;

        $this->object_learning_progress ??= ObjectLearningProgressService::new(
            $DIC->database(),
            $this->getObject(),
            $this->getUser()
        );

        return $this->object_learning_progress;
    }


    private function getOrganisationalUnit() : OrganisationalUnitService
    {
        global $DIC;

        $this->organisational_unit ??= OrganisationalUnitService::new(
            $DIC->database()
        );

        return $this->organisational_unit;
    }


    private function getOrganisationalUnitPosition() : OrganisationalUnitPositionService
    {
        global $DIC;

        $this->organisational_unit_position ??= OrganisationalUnitPositionService::new(
            $DIC->database()
        );

        return $this->organisational_unit_position;
    }


    private function getOrganisationalUnitStaff_() : OrganisationalUnitStaffService
    {
        global $DIC;

        $this->organisational_unit_staff ??= OrganisationalUnitStaffService::new(
            $DIC->database(),
            $this->getOrganisationalUnit(),
            $this->getUser(),
            $this->getOrganisationalUnitPosition()
        );

        return $this->organisational_unit_staff;
    }


    private function getRole() : RoleService
    {
        global $DIC;

        $this->role ??= RoleService::new(
            $DIC->database(),
            $this->getObject(),
            $DIC->rbac()
        );

        return $this->role;
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


    private function getUserFavourite() : UserFavouriteService
    {
        global $DIC;

        $this->user_favourite ??= UserFavouriteService::new(
            $DIC->database(),
            $this->getUser(),
            $this->getObject(),
            new ilFavouritesDBRepository()
        );

        return $this->user_favourite;
    }


    private function getUserMail() : UserMailService
    {
        global $DIC;

        $this->user_mail ??= UserMailService::new(
            $DIC->database(),
            $this->getUser()
        );

        return $this->user_mail;
    }


    private function getUserRole() : UserRoleService
    {
        global $DIC;

        $this->user_role ??= UserRoleService::new(
            $DIC->database(),
            $this->getUser(),
            $this->getRole(),
            $DIC->rbac()
        );

        return $this->user_role;
    }
}
