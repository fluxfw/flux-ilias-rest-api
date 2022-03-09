<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Adapter\Api\Change\LegacyChangeType;
use FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Adapter\Api\GroupMember\GroupMemberIdDto;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\UserRole\UserRoleDto;
use FluxIliasRestApi\Channel\Category\Port\CategoryService;
use FluxIliasRestApi\Channel\Change\ChangeQuery;
use FluxIliasRestApi\Channel\Course\Port\CourseService;
use FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use FluxIliasRestApi\Channel\File\Port\FileService;
use FluxIliasRestApi\Channel\Group\Port\GroupService;
use FluxIliasRestApi\Channel\GroupMember\Port\GroupMemberService;
use FluxIliasRestApi\Channel\Object\LegacyDefaultInternalObjectType;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\ObjectLearningProgress\Port\ObjectLearningProgressService;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasRestApi\Channel\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use FluxIliasRestApi\Channel\Role\Port\RoleService;
use FluxIliasRestApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\UserRole\Port\UserRoleService;
use ilDBConstants;
use ilDBInterface;
use ilObjCategory;
use ilObjCourse;
use ilObject;
use ilObjFile;
use ilObjGroup;
use ilObjOrgUnit;
use ilObjRole;
use ilObjSCORMLearningModule;
use ilObjUser;

class HandleIliasEventCommand
{

    use ChangeQuery;

    private CategoryService $category_service;
    private CourseMemberService $course_member_service;
    private CourseService $course_service;
    private FileService $file_service;
    private GroupMemberService $group_member_service;
    private GroupService $group_service;
    private ilDBInterface $ilias_database;
    private ObjectLearningProgressService $object_learning_progress_service;
    private ObjectService $object_service;
    private OrganisationalUnitService $organisational_unit_service;
    private OrganisationalUnitStaffService $organisational_unit_staff_service;
    private RoleService $role_service;
    private ScormLearningModuleService $scorm_learning_module_service;
    private UserRoleService $user_role_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ CategoryService $category_service,
        /*private readonly*/ CourseService $course_service,
        /*private readonly*/ CourseMemberService $course_member_service,
        /*private readonly*/ FileService $file_service,
        /*private readonly*/ GroupService $group_service,
        /*private readonly*/ GroupMemberService $group_member_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ObjectLearningProgressService $object_learning_progress_service,
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service,
        /*private readonly*/ OrganisationalUnitStaffService $organisational_unit_staff_service,
        /*private readonly*/ RoleService $role_service,
        /*private readonly*/ ScormLearningModuleService $scorm_learning_module_service,
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ UserRoleService $user_role_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->category_service = $category_service;
        $this->course_service = $course_service;
        $this->course_member_service = $course_member_service;
        $this->file_service = $file_service;
        $this->group_service = $group_service;
        $this->group_member_service = $group_member_service;
        $this->object_service = $object_service;
        $this->object_learning_progress_service = $object_learning_progress_service;
        $this->organisational_unit_service = $organisational_unit_service;
        $this->organisational_unit_staff_service = $organisational_unit_staff_service;
        $this->role_service = $role_service;
        $this->scorm_learning_module_service = $scorm_learning_module_service;
        $this->user_service = $user_service;
        $this->user_role_service = $user_role_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        CategoryService $category_service,
        CourseService $course_service,
        CourseMemberService $course_member_service,
        FileService $file_service,
        GroupService $group_service,
        GroupMemberService $group_member_service,
        ObjectService $object_service,
        ObjectLearningProgressService $object_learning_progress_service,
        OrganisationalUnitService $organisational_unit_service,
        OrganisationalUnitStaffService $organisational_unit_staff_service,
        RoleService $role_service,
        ScormLearningModuleService $scorm_learning_module_service,
        UserService $user_service,
        UserRoleService $user_role_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $category_service,
            $course_service,
            $course_member_service,
            $file_service,
            $group_service,
            $group_member_service,
            $object_service,
            $object_learning_progress_service,
            $organisational_unit_service,
            $organisational_unit_staff_service,
            $role_service,
            $scorm_learning_module_service,
            $user_service,
            $user_role_service
        );
    }


    public function handleIliasEvent(UserDto $user, string $component, string $event, array $parameters) : void
    {
        switch ($component) {
            case "Modules/Course":
                $this->handleCourse(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Modules/Group":
                $this->handleGroup(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Modules/OrgUnit":
                $this->handleOrganisationalUnit(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Services/AccessControl":
                $this->handleUserRole(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Services/Object":
                $this->handleObject(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Services/Tree":
                $this->handleTree(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Services/Tracking":
                $this->handleObjectLearningProgress(
                    $user,
                    $event,
                    $parameters
                );
                break;
            case "Services/User":
                $this->handleUser(
                    $user,
                    $event,
                    $parameters
                );
                break;
            default:
                break;
        }
    }


    private function getCategoryData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->category_service->getCategoryByRefId(
                $ref_id
            );
        } else {
            return $this->category_service->getCategoryById(
                $id
            );
        }
    }


    private function getCourseData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->course_service->getCourseByRefId(
                $ref_id
            );
        } else {
            return $this->course_service->getCourseById(
                $id
            );
        }
    }


    private function getCourseMemberData(int $course_id, int $user_id) : object
    {
        return $this->course_member_service->getCourseMembers(
                $course_id,
                null,
                null,
                $user_id
            )[0] ?? CourseMemberIdDto::new(
                $course_id,
                null,
                null,
                $user_id
            );
    }


    private function getFileData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->file_service->getFileByRefId(
                $ref_id
            );
        } else {
            return $this->file_service->getFileById(
                $id
            );
        }
    }


    private function getGroupData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->group_service->getGroupByRefId(
                $ref_id
            );
        } else {
            return $this->group_service->getGroupById(
                $id
            );
        }
    }


    private function getGroupMemberData(int $group_id, int $user_id) : object
    {
        return $this->group_member_service->getGroupMembers(
                $group_id,
                null,
                null,
                $user_id
            )[0] ?? GroupMemberIdDto::new(
                $group_id,
                null,
                null,
                $user_id
            );
    }


    private function getObjectData(?int $id = null, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->object_service->getObjectByRefId(
                $ref_id
            );
        } else {
            if ($id !== null) {
                return $this->object_service->getObjectById(
                    $id
                );
            }
        }

        return null;
    }


    private function getObjectLearningProgressData(int $object_id, int $user_id) : object
    {
        return $this->object_learning_progress_service->getObjectLearningProgress(
                $object_id,
                null,
                null,
                $user_id
            )[0] ?? ObjectLearningProgressIdDto::new(
                $object_id,
                null,
                null,
                $user_id
            );
    }


    private function getOrganisationalUnitData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $ref_id
            );
        } else {
            return $this->organisational_unit_service->getOrganisationalUnitById(
                $id
            );
        }
    }


    private function getOrganisationalUnitStaffData(int $organisational_unit_ref_id, int $user_id, int $position_id) : object
    {
        return $this->organisational_unit_staff_service->getOrganisationalUnitStaff(
                null,
                null,
                $organisational_unit_ref_id,
                $user_id,
                null,
                $position_id
            )[0] ?? OrganisationalUnitStaffDto::new(
                null,
                null,
                $organisational_unit_ref_id,
                $user_id,
                null,
                $position_id
            );
    }


    private function getRoleData(int $id) : ?object
    {
        return $this->role_service->getRoleById(
            $id
        );
    }


    private function getScormLearningModuleData(int $id, ?int $ref_id = null) : ?object
    {
        if ($ref_id !== null) {
            return $this->scorm_learning_module_service->getScormLearningModuleByRefId(
                $ref_id
            );
        } else {
            return $this->scorm_learning_module_service->getScormLearningModuleById(
                $id
            );
        }
    }


    private function getUserData(int $id) : ?object
    {
        return $this->user_service->getUserById(
            $id
        );
    }


    private function getUserRoleData(int $user_id, int $role_id) : object
    {
        return $this->user_role_service->getUserRoles(
                $user_id,
                null,
                $role_id
            )[0] ?? UserRoleDto::new(
                $user_id,
                null,
                $role_id
            );
    }


    private function handleCategoryCreated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_CATEGORY(),
            $user,
            $this->getCategoryData(
                $id
            )
        );
    }


    private function handleCategoryDeleted(UserDto $user, ilObjCategory $ilias_category) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_CATEGORY(),
            $user,
            $this->getObjectData(
                $ilias_category->getId(),
                $ilias_category->getRefId() ?: null
            )
        );
    }


    private function handleCategoryUpdated(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_CATEGORY(),
            $user,
            $this->getCategoryData(
                $id,
                $ref_id
            )
        );
    }


    private function handleCourse(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "addParticipant":
                $this->handleCourseMemberAdded(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"]
                );
                break;
            case "create":
                $this->handleCourseCreated(
                    $user,
                    $parameters["object"]
                );
                break;
            case "deleteParticipant":
                $this->handleCourseMemberRemoved(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"]
                );
                break;
            case "update":
                $this->handleCourseUpdated(
                    $user,
                    $parameters["object"]
                );
                break;
            default:
                break;
        }
    }


    private function handleCourseCreated(UserDto $user, ilObjCourse $ilias_course) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_COURSE(),
            $user,
            $this->getCourseData(
                $ilias_course->getId(),
                $ilias_course->getRefId() ?: null
            )
        );
    }


    private function handleCourseDeleted(UserDto $user, ilObjCourse $ilias_course) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_COURSE(),
            $user,
            $this->getObjectData(
                $ilias_course->getId(),
                $ilias_course->getRefId() ?: null
            )
        );
    }


    private function handleCourseMemberAdded(UserDto $user, int $course_id, int $user_id) : void
    {
        $this->storeChange(
            LegacyChangeType::ADDED_COURSE_MEMBER(),
            $user,
            $this->getCourseMemberData(
                $course_id,
                $user_id
            )
        );
    }


    private function handleCourseMemberRemoved(UserDto $user, int $course_id, int $user_id) : void
    {
        $this->storeChange(
            LegacyChangeType::REMOVED_COURSE_MEMBER(),
            $user,
            $this->getCourseMemberData(
                $course_id,
                $user_id
            )
        );
    }


    private function handleCourseUpdated(UserDto $user, ilObjCourse $ilias_course) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_COURSE(),
            $user,
            $this->getCourseData(
                $ilias_course->getId(),
                $ilias_course->getRefId() ?: null
            )
        );
    }


    private function handleFileCreated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_FILE(),
            $user,
            $this->getFileData(
                $id
            )
        );
    }


    private function handleFileDeleted(UserDto $user, ilObjFile $ilias_file) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_FILE(),
            $user,
            $this->getObjectData(
                $ilias_file->getId(),
                $ilias_file->getRefId() ?: null
            )
        );
    }


    private function handleFileUpdated(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_FILE(),
            $user,
            $this->getFileData(
                $id,
                $ref_id
            )
        );
    }


    private function handleGroup(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "addParticipant":
                $this->handleGroupMemberAdded(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"]
                );
                break;
            case "create":
                $this->handleGroupCreated(
                    $user,
                    $parameters["object"]
                );
                break;
            case "deleteParticipant":
                $this->handleGroupMemberRemoved(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"]
                );
                break;
            case "update":
                $this->handleGroupUpdated(
                    $user,
                    $parameters["object"]
                );
                break;
            default:
                break;
        }
    }


    private function handleGroupCreated(UserDto $user, ilObjGroup $ilias_group) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_GROUP(),
            $user,
            $this->getGroupData(
                $ilias_group->getId(),
                $ilias_group->getRefId() ?: null
            )
        );
    }


    private function handleGroupDeleted(UserDto $user, ilObjGroup $ilias_group) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_GROUP(),
            $user,
            $this->getObjectData(
                $ilias_group->getId(),
                $ilias_group->getRefId() ?: null
            )
        );
    }


    private function handleGroupMemberAdded(UserDto $user, int $group_id, int $user_id) : void
    {
        $this->storeChange(
            LegacyChangeType::ADDED_GROUP_MEMBER(),
            $user,
            $this->getGroupMemberData(
                $group_id,
                $user_id
            )
        );
    }


    private function handleGroupMemberRemoved(UserDto $user, int $group_id, int $user_id) : void
    {
        $this->storeChange(
            LegacyChangeType::REMOVED_GROUP_MEMBER(),
            $user,
            $this->getGroupMemberData(
                $group_id,
                $user_id
            )
        );
    }


    private function handleGroupUpdated(UserDto $user, ilObjGroup $ilias_group) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_GROUP(),
            $user,
            $this->getGroupData(
                $ilias_group->getId(),
                $ilias_group->getRefId() ?: null
            )
        );
    }


    private function handleObject(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "beforeDeletion":
                $this->handleObjectDeleted(
                    $user,
                    $parameters["object"]
                );
                break;
            case "cloneObject":
                $this->handleObjectCloned(
                    $user,
                    $parameters["object"]
                );
                break;
            case "create":
                $this->handleObjectCreated(
                    $user,
                    $parameters["obj_type"],
                    $parameters["obj_id"]
                );
                break;
            case "putObjectInTree":
                $this->handleObjectLinked(
                    $user,
                    $parameters["object"]
                );
                break;
            case "toTrash":
                $this->handleObjectMovedToTrash(
                    $user,
                    $parameters["obj_id"],
                    $parameters["ref_id"] ?: null
                );
                break;
            case "undelete":
                $this->handleObjectRestoredFromTrash(
                    $user,
                    $parameters["obj_id"],
                    $parameters["ref_id"] ?: null
                );
                break;
            case "update":
                $this->handleObjectUpdated(
                    $user,
                    $parameters["obj_type"],
                    $parameters["obj_id"],
                    $parameters["ref_id"] ?: null
                );
                break;
            default:
                break;
        }
    }


    private function handleObjectCloned(UserDto $user, ilObject $ilias_object) : void
    {
        $this->storeChange(
            LegacyChangeType::CLONED_OBJECT(),
            $user,
            $this->getObjectData(
                $ilias_object->getId(),
                $ilias_object->getRefId() ?: null
            )
        );
    }


    private function handleObjectCreated(UserDto $user, string $type, int $id) : void
    {
        switch ($type) {
            case LegacyDefaultInternalObjectType::CAT()->value:
                $this->handleCategoryCreated(
                    $user,
                    $id
                );
                break;
            case LegacyDefaultInternalObjectType::CRS()->value:
            case LegacyDefaultInternalObjectType::GRP()->value:
            case LegacyDefaultInternalObjectType::USR()->value:
                break;
            case LegacyDefaultInternalObjectType::FILE()->value:
                $this->handleFileCreated(
                    $user,
                    $id
                );
                break;
            case LegacyDefaultInternalObjectType::ORGU()->value:
                $this->handleOrganisationalUnitCreated(
                    $user,
                    $id
                );
                break;
            case LegacyDefaultInternalObjectType::ROLE()->value:
                $this->handleRoleCreated(
                    $user,
                    $id
                );
                break;
            case LegacyDefaultInternalObjectType::SAHS()->value:
                $this->handleScormLearningModuleCreated(
                    $user,
                    $id
                );
                break;
            default:
                $this->storeChange(
                    LegacyChangeType::CREATED_OBJECT(),
                    $user,
                    $this->getObjectData(
                        $id
                    )
                );
                break;
        }
    }


    private function handleObjectDeleted(UserDto $user, ilObject $ilias_object) : void
    {
        switch (true) {
            case $ilias_object instanceof ilObjCategory:
                $this->handleCategoryDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjCourse:
                $this->handleCourseDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjFile:
                $this->handleFileDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjGroup:
                $this->handleGroupDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjOrgUnit:
                $this->handleOrganisationalUnitDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjRole:
                $this->handleRoleDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjSCORMLearningModule:
                $this->handleScormLearningModuleDeleted(
                    $user,
                    $ilias_object
                );
                break;
            case $ilias_object instanceof ilObjUser:
                $this->handleUserDeleted(
                    $user,
                    $ilias_object
                );
                break;
            default:
                $this->storeChange(
                    LegacyChangeType::DELETED_OBJECT(),
                    $user,
                    $this->getObjectData(
                        $ilias_object->getId(),
                        $ilias_object->getRefId() ?: null
                    )
                );
                break;
        }
    }


    private function handleObjectLearningProgress(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "updateStatus":
                $this->handleObjectLearningProgressUpdated(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"]
                );
                break;
            default:
                break;
        }
    }


    private function handleObjectLearningProgressUpdated(UserDto $user, int $object_id, int $user_id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_OBJECT_LEARNING_PROGRESS(),
            $user,
            $this->getObjectLearningProgressData(
                $object_id,
                $user_id
            )
        );
    }


    private function handleObjectLinked(UserDto $user, ilObject $ilias_object) : void
    {
        $this->storeChange(
            LegacyChangeType::LINKED_OBJECT(),
            $user,
            $this->getObjectData(
                $ilias_object->getId(),
                $ilias_object->getRefId() ?: null
            )
        );
    }


    private function handleObjectMoved(UserDto $user, int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::MOVED_OBJECT(),
            $user,
            $this->getObjectData(
                null,
                $ref_id
            )
        );
    }


    private function handleObjectMovedToTrash(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::MOVED_OBJECT_TO_TRASH(),
            $user,
            $this->getObjectData(
                $id,
                $ref_id
            )
        );
    }


    private function handleObjectRestoredFromTrash(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::RESTORED_OBJECT_FROM_TRASH(),
            $user,
            $this->getObjectData(
                $id,
                $ref_id
            )
        );
    }


    private function handleObjectUpdated(UserDto $user, string $type, int $id, ?int $ref_id) : void
    {
        switch ($type) {
            case LegacyDefaultInternalObjectType::CAT()->value:
                $this->handleCategoryUpdated(
                    $user,
                    $id,
                    $ref_id
                );
                break;
            case LegacyDefaultInternalObjectType::CRS()->value:
            case LegacyDefaultInternalObjectType::GRP()->value:
            case LegacyDefaultInternalObjectType::USR()->value:
                break;
            case LegacyDefaultInternalObjectType::FILE()->value:
                $this->handleFileUpdated(
                    $user,
                    $id,
                    $ref_id
                );
                break;
            case LegacyDefaultInternalObjectType::ORGU()->value:
                $this->handleOrganisationalUnitUpdated(
                    $user,
                    $id,
                    $ref_id
                );
                break;
            case LegacyDefaultInternalObjectType::ROLE()->value:
                $this->handleRoleUpdated(
                    $user,
                    $id
                );
                break;
            case LegacyDefaultInternalObjectType::SAHS()->value:
                $this->handleScormLearningModuleUpdated(
                    $user,
                    $id,
                    $ref_id
                );
                break;
            default:
                $this->storeChange(
                    LegacyChangeType::UPDATED_OBJECT(),
                    $user,
                    $this->getObjectData(
                        $id,
                        $ref_id
                    )
                );
                break;
        }
    }


    private function handleOrganisationalUnit(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "assignUserToPosition":
                $this->handleOrganisationalUnitStaffAdded(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"],
                    $parameters["position_id"]
                );
                break;
            case "deassignUserFromPosition":
                $this->handleOrganisationalUnitStaffRemoved(
                    $user,
                    $parameters["obj_id"],
                    $parameters["usr_id"],
                    $parameters["position_id"]
                );
                break;
            default:
                break;
        }
    }


    private function handleOrganisationalUnitCreated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_ORGANISATIONAL_UNIT(),
            $user,
            $this->getOrganisationalUnitData(
                $id
            )
        );
    }


    private function handleOrganisationalUnitDeleted(UserDto $user, ilObjOrgUnit $ilias_organisational_unit) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_ORGANISATIONAL_UNIT(),
            $user,
            $this->getObjectData(
                $ilias_organisational_unit->getId(),
                $ilias_organisational_unit->getRefId() ?: null
            )
        );
    }


    private function handleOrganisationalUnitStaffAdded(UserDto $user, int $organisational_unit_ref_id, int $user_id, int $position_id) : void
    {
        $this->storeChange(
            LegacyChangeType::ADDED_ORGANISATIONAL_UNIT_STAFF(),
            $user,
            $this->getOrganisationalUnitStaffData(
                $organisational_unit_ref_id,
                $user_id,
                $position_id
            )
        );
    }


    private function handleOrganisationalUnitStaffRemoved(UserDto $user, int $organisational_unit_ref_id, int $user_id, int $position_id) : void
    {
        $this->storeChange(
            LegacyChangeType::REMOVED_ORGANISATIONAL_UNIT_STAFF(),
            $user,
            $this->getOrganisationalUnitStaffData(
                $organisational_unit_ref_id,
                $user_id,
                $position_id
            )
        );
    }


    private function handleOrganisationalUnitUpdated(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_ORGANISATIONAL_UNIT(),
            $user,
            $this->getOrganisationalUnitData(
                $id,
                $ref_id
            )
        );
    }


    private function handleRoleCreated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_ROLE(),
            $user,
            $this->getRoleData(
                $id
            )
        );
    }


    private function handleRoleDeleted(UserDto $user, ilObjRole $ilias_role) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_ROLE(),
            $user,
            $this->getObjectData(
                $ilias_role->getId()
            )
        );
    }


    private function handleRoleUpdated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_ROLE(),
            $user,
            $this->getRoleData(
                $id
            )
        );
    }


    private function handleScormLearningModuleCreated(UserDto $user, int $id) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_SCORM_LEARNING_MODULE(),
            $user,
            $this->getScormLearningModuleData(
                $id
            )
        );
    }


    private function handleScormLearningModuleDeleted(UserDto $user, ilObjSCORMLearningModule $ilias_scorm_learning_module) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_SCORM_LEARNING_MODULE(),
            $user,
            $this->getObjectData(
                $ilias_scorm_learning_module->getId(),
                $ilias_scorm_learning_module->getRefId() ?: null
            )
        );
    }


    private function handleScormLearningModuleUpdated(UserDto $user, int $id, ?int $ref_id) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_SCORM_LEARNING_MODULE(),
            $user,
            $this->getScormLearningModuleData(
                $id,
                $ref_id
            )
        );
    }


    private function handleTree(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "moveTree":
                $this->handleObjectMoved(
                    $user,
                    $parameters["source_id"]
                );
                break;
            default:
                break;
        }
    }


    private function handleUser(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "afterCreate":
                $this->handleUserCreated(
                    $user,
                    $parameters["user_obj"]
                );
                break;
            case "afterUpdate":
                $this->handleUserUpdated(
                    $user,
                    $parameters["user_obj"]
                );
                break;
            default:
                break;
        }
    }


    private function handleUserCreated(UserDto $user, ilObjUser $ilias_user) : void
    {
        $this->storeChange(
            LegacyChangeType::CREATED_USER(),
            $user,
            $this->getUserData(
                $ilias_user->getId()
            )
        );
    }


    private function handleUserDeleted(UserDto $user, ilObjUser $ilias_user) : void
    {
        $this->storeChange(
            LegacyChangeType::DELETED_USER(),
            $user,
            $this->getObjectData(
                $ilias_user->getId()
            )
        );
    }


    private function handleUserRole(UserDto $user, string $event, array $parameters) : void
    {
        switch ($event) {
            case "assignUser":
                $this->handleUserRoleAdded(
                    $user,
                    $parameters["usr_id"],
                    $parameters["role_id"]
                );
                break;
            case "deassignUser":
                $this->handleUserRoleRemoved(
                    $user,
                    $parameters["usr_id"],
                    $parameters["role_id"]
                );
                break;
            default:
                break;
        }
    }


    private function handleUserRoleAdded(UserDto $user, int $user_id, int $role_id) : void
    {
        $this->storeChange(
            LegacyChangeType::ADDED_USER_ROLE(),
            $user,
            $this->getUserRoleData(
                $user_id,
                $role_id
            )
        );
    }


    private function handleUserRoleRemoved(UserDto $user, int $user_id, int $role_id) : void
    {
        $this->storeChange(
            LegacyChangeType::REMOVED_USER_ROLE(),
            $user,
            $this->getUserRoleData(
                $user_id,
                $role_id
            )
        );
    }


    private function handleUserUpdated(UserDto $user, ilObjUser $ilias_user) : void
    {
        $this->storeChange(
            LegacyChangeType::UPDATED_USER(),
            $user,
            $this->getUserData(
                $ilias_user->getId()
            )
        );
    }


    private function storeChange(LegacyChangeType $type, UserDto $user, ?object $data) : void
    {
        $this->ilias_database->insert($this->getChangeDatabaseTable(), [
            "type"           => [ilDBConstants::T_TEXT, $type->value],
            "time"           => [ilDBConstants::T_FLOAT, microtime(true)],
            "user_id"        => [ilDBConstants::T_INTEGER, $user->getId()],
            "user_import_id" => [ilDBConstants::T_TEXT, $user->getImportId()],
            "data"           => [ilDBConstants::T_BLOB, json_encode($data ?? (object) [], JSON_UNESCAPED_SLASHES)]
        ]);
    }
}
