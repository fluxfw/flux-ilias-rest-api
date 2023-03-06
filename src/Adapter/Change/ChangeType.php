<?php

namespace FluxIliasRestApi\Adapter\Change;

enum ChangeType: string
{

    case ADDED_COURSE_MEMBER = "added_course_member";
    case ADDED_GROUP_MEMBER = "added_group_member";
    case ADDED_ORGANISATIONAL_UNIT_STAFF = "added_organisational_unit_staff";
    case ADDED_USER_ROLE = "added_user_role";
    case CLONED_OBJECT = "cloned_object";
    case CREATED_CATEGORY = "created_category";
    case CREATED_COURSE = "created_course";
    case CREATED_FILE = "created_file";
    case CREATED_FLUX_ILIAS_REST_OBJECT = "created_flux_ilias_rest_object";
    case CREATED_GROUP = "created_group";
    case CREATED_OBJECT = "created_object";
    case CREATED_ORGANISATIONAL_UNIT = "created_organisational_unit";
    case CREATED_ROLE = "created_role";
    case CREATED_SCORM_LEARNING_MODULE = "created_scorm_learning_module";
    case CREATED_USER = "created_user";
    case DELETED_CATEGORY = "deleted_category";
    case DELETED_COURSE = "deleted_course";
    case DELETED_FILE = "deleted_file";
    case DELETED_FLUX_ILIAS_REST_OBJECT = "deleted_flux_ilias_rest_object";
    case DELETED_GROUP = "deleted_group";
    case DELETED_OBJECT = "deleted_object";
    case DELETED_ORGANISATIONAL_UNIT = "deleted_organisational_unit";
    case DELETED_ROLE = "deleted_role";
    case DELETED_SCORM_LEARNING_MODULE = "deleted_scorm_learning_module";
    case DELETED_USER = "deleted_user";
    case LINKED_OBJECT = "linked_object";
    case MOVED_OBJECT = "moved_object";
    case MOVED_OBJECT_TO_TRASH = "moved_object_to_trash";
    case REMOVED_COURSE_MEMBER = "removed_course_member";
    case REMOVED_GROUP_MEMBER = "removed_group_member";
    case REMOVED_ORGANISATIONAL_UNIT_STAFF = "removed_organisational_unit_staff";
    case REMOVED_USER_ROLE = "removed_user_role";
    case RESTORED_OBJECT_FROM_TRASH = "restored_object_from_trash";
    case UPDATED_CATEGORY = "updated_category";
    case UPDATED_COURSE = "updated_course";
    case UPDATED_FILE = "updated_file";
    case UPDATED_FLUX_ILIAS_REST_OBJECT = "updated_flux_ilias_rest_object";
    case UPDATED_GROUP = "updated_group";
    case UPDATED_OBJECT = "updated_object";
    case UPDATED_OBJECT_LEARNING_PROGRESS = "updated_object_learning_progress";
    case UPDATED_ORGANISATIONAL_UNIT = "updated_organisational_unit";
    case UPDATED_ROLE = "updated_role";
    case UPDATED_SCORM_LEARNING_MODULE = "updated_scorm_learning_module";
    case UPDATED_USER = "updated_user";
}
