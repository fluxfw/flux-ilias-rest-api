<?php

namespace FluxIliasRestApi\Adapter\Api;

use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxIliasRestApi\Adapter\Api\Category\CategoryDto;
use FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Adapter\Api\File\FileDiffDto;
use FluxIliasRestApi\Adapter\Api\File\FileDto;
use FluxIliasRestApi\Adapter\Api\Group\GroupDiffDto;
use FluxIliasRestApi\Adapter\Api\Group\GroupDto;
use FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberDiffDto;
use FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectType;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDiffDto;
use FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDiffDto;
use FluxIliasRestApi\Adapter\Api\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use FluxIliasRestApi\Adapter\Api\UserFavourite\UserFavouriteDto;
use FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use FluxIliasRestApi\Channel\Category\Port\CategoryService;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Channel\Config\Port\ConfigService;
use FluxIliasRestApi\Channel\Course\Port\CourseService;
use FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use FluxIliasRestApi\Channel\Cron\Port\CronService;
use FluxIliasRestApi\Channel\File\Port\FileService;
use FluxIliasRestApi\Channel\Group\Port\GroupService;
use FluxIliasRestApi\Channel\GroupMember\Port\GroupMemberService;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\ObjectLearningProgress\Port\ObjectLearningProgressService;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Channel\Setup\Port\SetupService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\UserFavourite\Port\UserFavouriteService;
use FluxIliasRestApi\Channel\UserMail\Port\UserMailService;
use FluxIliasRestApi\Channel\UserRole\Port\UserRoleService;
use ilCronJob;
use ilFavouritesDBRepository;

class Api
{

    private CategoryService $category;
    private ChangeService $change;
    private ConfigService $config;
    private CourseService $course;
    private CourseMemberService $course_member;
    private CronService $cron;
    private FileService $file;
    private GroupService $group;
    private GroupMemberService $group_member;
    private ObjectService $object;
    private ObjectLearningProgressService $object_learning_progress;
    private OrganisationalUnitService $organisational_unit;
    private OrganisationalUnitPositionService $organisational_unit_position;
    private OrganisationalUnitStaffService $organisational_unit_staff;
    private RoleService $role;
    private ScormLearningModuleService $scorm_learning_module;
    private SetupService $setup;
    private UserService $user;
    private UserFavouriteService $user_favourite;
    private UserMailService $user_mail;
    private UserRoleService $user_role;


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


    public function cloneObjectByIdToId(int $id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToId(
                $id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByIdToImportId(int $id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToImportId(
                $id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByIdToRefId(int $id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByIdToRefId(
                $id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToId(string $import_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToId(
                $import_id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToImportId(string $import_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToImportId(
                $import_id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByImportIdToRefId(string $import_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByImportIdToRefId(
                $import_id,
                $parent_ref_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToId(int $ref_id, int $parent_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToId(
                $ref_id,
                $parent_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToImportId(int $ref_id, string $parent_import_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToImportId(
                $ref_id,
                $parent_import_id,
                $link,
                $prefer_link
            );
    }


    public function cloneObjectByRefIdToRefId(int $ref_id, int $parent_ref_id, bool $link = false, bool $prefer_link = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->cloneObjectByRefIdToRefId(
                $ref_id,
                $parent_ref_id,
                $link,
                $prefer_link
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


    public function createObjectToId(ObjectType $type, int $parent_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->createObjectToId(
                $type,
                $parent_id,
                $diff
            );
    }


    public function createObjectToImportId(ObjectType $type, string $parent_import_id, ObjectDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getObject()
            ->createObjectToImportId(
                $type,
                $parent_import_id,
                $diff
            );
    }


    public function createObjectToRefId(ObjectType $type, int $parent_ref_id, ObjectDiffDto $diff) : ?ObjectIdDto
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


    public function createRoleToId(int $object_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToId(
                $object_id,
                $diff
            );
    }


    public function createRoleToImportId(string $object_import_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToImportId(
                $object_import_id,
                $diff
            );
    }


    public function createRoleToRefId(int $object_ref_id, RoleDiffDto $diff) : ?ObjectIdDto
    {
        return $this->getRole()
            ->createRoleToRefId(
                $object_ref_id,
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


    public function deleteObjectById(int $id, bool $force = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectById(
                $id,
                $force
            );
    }


    public function deleteObjectByImportId(string $import_id, bool $force = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectByImportId(
                $import_id,
                $force
            );
    }


    public function deleteObjectByRefId(int $ref_id, bool $force = false) : ?ObjectIdDto
    {
        return $this->getObject()
            ->deleteObjectByRefId(
                $ref_id,
                $force
            );
    }


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return $this->getOrganisationalUnitPosition()
            ->deleteOrganisationalUnitPositionById(
                $id
            );
    }


    public function getCategories(?bool $in_trash = null) : array
    {
        return $this->getCategory()
            ->getCategories(
                $in_trash
            );
    }


    public function getCategoryById(int $id, ?bool $in_trash = null) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryById(
                $id,
                $in_trash
            );
    }


    public function getCategoryByImportId(string $import_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCategoryByRefId(int $ref_id, ?bool $in_trash = null) : ?CategoryDto
    {
        return $this->getCategory()
            ->getCategoryByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : ?array
    {
        return $this->getChange()
            ->getChanges(
                $from,
                $to,
                $after,
                $before
            );
    }


    public function getChildrenById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getChildrenById(
                $id,
                $ref_ids,
                $in_trash
            );
    }


    public function getChildrenByImportId(string $import_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getChildrenByImportId(
                $import_id,
                $ref_ids,
                $in_trash
            );
    }


    public function getChildrenByRefId(int $ref_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getChildrenByRefId(
                $ref_id,
                $ref_ids,
                $in_trash
            );
    }


    public function getCourseById(int $id, ?bool $in_trash = null) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseById(
                $id,
                $in_trash
            );
    }


    public function getCourseByImportId(string $import_id, ?bool $in_trash = null) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCourseByRefId(int $ref_id, ?bool $in_trash = null) : ?CourseDto
    {
        return $this->getCourse()
            ->getCourseByRefId(
                $ref_id,
                $in_trash
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
        ?LegacyObjectLearningProgress $learning_progress = null,
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


    public function getCourses(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        return $this->getCourse()
            ->getCourses(
                $container_settings,
                $in_trash
            );
    }


    public function getCronJob(string $id) : ?ilCronJob
    {
        return $this->getCron()
            ->getCronJob(
                $id
            );
    }


    public function getCronJobs() : array
    {
        return $this->getCron()
            ->getCronJobs();
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


    public function getFileById(int $id, ?bool $in_trash = null) : ?FileDto
    {
        return $this->getFile()
            ->getFileById(
                $id,
                $in_trash
            );
    }


    public function getFileByImportId(string $import_id, ?bool $in_trash = null) : ?FileDto
    {
        return $this->getFile()
            ->getFileByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getFileByRefId(int $ref_id, ?bool $in_trash = null) : ?FileDto
    {
        return $this->getFile()
            ->getFileByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getFiles(?bool $in_trash = null) : array
    {
        return $this->getFile()
            ->getFiles(
                $in_trash
            );
    }


    public function getGlobalRoleObject() : ?ObjectDto
    {
        return $this->getRole()
            ->getGlobalRoleObject();
    }


    public function getGroupById(int $id, ?bool $in_trash = null) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupById(
                $id,
                $in_trash
            );
    }


    public function getGroupByImportId(string $import_id, ?bool $in_trash = null) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getGroupByRefId(int $ref_id, ?bool $in_trash = null) : ?GroupDto
    {
        return $this->getGroup()
            ->getGroupByRefId(
                $ref_id,
                $in_trash
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
        ?LegacyObjectLearningProgress $learning_progress = null,
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


    public function getGroups(?bool $in_trash = null) : array
    {
        return $this->getGroup()
            ->getGroups(
                $in_trash
            );
    }


    public function getObjectById(int $id, ?bool $in_trash = null) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectById(
                $id,
                $in_trash
            );
    }


    public function getObjectByImportId(string $import_id, ?bool $in_trash = null) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getObjectByRefId(int $ref_id, ?bool $in_trash = null) : ?ObjectDto
    {
        return $this->getObject()
            ->getObjectByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getObjectLearningProgress(
        ?int $object_id = null,
        ?string $object_import_id = null,
        ?int $object_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?LegacyObjectLearningProgress $learning_progress = null
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


    public function getObjects(ObjectType $type, bool $ref_ids = false, ?bool $in_trash = null) : array
    {
        return $this->getObject()
            ->getObjects(
                $type,
                $ref_ids,
                $in_trash
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


    public function getOrganisationalUnitPositionByCoreIdentifier(LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier) : ?OrganisationalUnitPositionDto
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


    public function getPathById(int $id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getPathById(
                $id,
                $ref_ids,
                $in_trash
            );
    }


    public function getPathByImportId(string $import_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getPathByImportId(
                $import_id,
                $ref_ids,
                $in_trash
            );
    }


    public function getPathByRefId(int $ref_id, bool $ref_ids = false, ?bool $in_trash = null) : ?array
    {
        return $this->getObject()
            ->getPathByRefId(
                $ref_id,
                $ref_ids,
                $in_trash
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


    public function getScormLearningModuleById(int $id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleById(
                $id,
                $in_trash
            );
    }


    public function getScormLearningModuleByImportId(string $import_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getScormLearningModuleByRefId(int $ref_id, ?bool $in_trash = null) : ?ScormLearningModuleDto
    {
        return $this->getScormLearningModule()
            ->getScormLearningModuleByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getScormLearningModules(?bool $in_trash = null) : array
    {
        return $this->getScormLearningModule()
            ->getScormLearningModules(
                $in_trash
            );
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


    public function handleIliasEvent(string $component, string $event, array $parameters) : void
    {
        $user = $this->getCurrentApiUser();
        if ($user === null) {
            return;
        }

        $this->getChange()->handleIliasEvent(
            $user,
            $component,
            $event,
            $parameters
        );
    }


    public function installHelperPlugin() : void
    {
        $this->getSetup()
            ->installHelperPlugin();
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


    public function purgeChanges() : void
    {
        $this->getChange()
            ->purgeChanges();
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


    public function transferChanges() : void
    {
        $this->getChange()
            ->transferChanges();
    }


    public function uninstallHelperPlugin() : void
    {
        $this->getSetup()
            ->uninstallHelperPlugin();
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


    public function updateObjectLearningProgressByIdByUserId(int $id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByIdByUserId(
                $id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByIdByUserImportId(int $id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByIdByUserImportId(
                $id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserId(string $import_id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByImportIdByUserId(
                $import_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByImportIdByUserImportId(string $import_id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserId(int $ref_id, int $user_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
    {
        return $this->getObjectLearningProgress_()
            ->updateObjectLearningProgressByRefIdByUserId(
                $ref_id,
                $user_id,
                $learning_progress
            );
    }


    public function updateObjectLearningProgressByRefIdByUserImportId(int $ref_id, string $user_import_id, LegacyObjectLearningProgress $learning_progress) : ?ObjectLearningProgressIdDto
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


    private function getChange() : ChangeService
    {
        global $DIC;

        $this->change ??= ChangeService::new(
            $DIC->database(),
            $this->getConfig(),
            $this->getCategory(),
            $this->getCourse(),
            $this->getCourseMember(),
            $this->getFile(),
            $this->getGroup(),
            $this->getGroupMember(),
            $this->getObject(),
            $this->getObjectLearningProgress_(),
            $this->getOrganisationalUnit(),
            $this->getOrganisationalUnitStaff_(),
            $this->getRole(),
            $this->getScormLearningModule(),
            $this->getUser(),
            $this->getUserRole()
        );

        return $this->change;
    }


    private function getConfig() : ConfigService
    {
        $this->config ??= ConfigService::new();

        return $this->config;
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


    private function getCron() : CronService
    {
        global $DIC;

        $this->cron ??= CronService::new(
            $DIC->database(),
            $this->getChange()
        );

        return $this->cron;
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
            $DIC->repositoryTree(),
            $DIC->user(),
            $DIC["objDefinition"]
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


    private function getSetup() : SetupService
    {
        $this->setup ??= SetupService::new(
            $this->getChange(),
            $this->getConfig(),
            $this->getCron()
        );

        return $this->setup;
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
