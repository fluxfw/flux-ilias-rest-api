<?php

namespace FluxIliasRestApi\Adapter\Change;

enum ChangeType: string
{

    case ADDED_COURSE_MEMBER = "added-course-member";
    case ADDED_GROUP_MEMBER = "added-group-member";
    case ADDED_ORGANISATIONAL_UNIT_STAFF = "added-organisational-unit-staff";
    case ADDED_USER_ROLE = "added-user-role";
    case CLONED_OBJECT = "cloned-object";
    case CREATED_CATEGORY = "created-category";
    case CREATED_COURSE = "created-course";
    case CREATED_FILE = "created-file";
    case CREATED_FLUX_ILIAS_REST_OBJECT = "created-flux-ilias-rest-object";
    case CREATED_GROUP = "created-group";
    case CREATED_OBJECT = "created-object";
    case CREATED_ORGANISATIONAL_UNIT = "created-organisational-unit";
    case CREATED_ROLE = "created-role";
    case CREATED_SCORM_LEARNING_MODULE = "created-scorm-learning-module";
    case CREATED_USER = "created-user";
    case DELETED_CATEGORY = "deleted-category";
    case DELETED_COURSE = "deleted-course";
    case DELETED_FILE = "deleted-file";
    case DELETED_FLUX_ILIAS_REST_OBJECT = "deleted-flux-ilias-rest-object";
    case DELETED_GROUP = "deleted-group";
    case DELETED_OBJECT = "deleted-object";
    case DELETED_ORGANISATIONAL_UNIT = "deleted-organisational-unit";
    case DELETED_ROLE = "deleted-role";
    case DELETED_SCORM_LEARNING_MODULE = "deleted-scorm-learning-module";
    case DELETED_USER = "deleted-user";
    case LINKED_OBJECT = "linked-object";
    case MOVED_OBJECT = "moved-object";
    case MOVED_OBJECT_TO_TRASH = "moved-object-to-trash";
    case REMOVED_COURSE_MEMBER = "removed-course-member";
    case REMOVED_GROUP_MEMBER = "removed-group-member";
    case REMOVED_ORGANISATIONAL_UNIT_STAFF = "removed-organisational-unit-staff";
    case REMOVED_USER_ROLE = "removed-user-role";
    case RESTORED_OBJECT_FROM_TRASH = "restored-object-from-trash";
    case UPDATED_CATEGORY = "updated-category";
    case UPDATED_COURSE = "updated-course";
    case UPDATED_FILE = "updated-file";
    case UPDATED_FLUX_ILIAS_REST_OBJECT = "updated-flux-ilias-rest-object";
    case UPDATED_GROUP = "updated-group";
    case UPDATED_OBJECT = "updated-object";
    case UPDATED_OBJECT_LEARNING_PROGRESS = "updated-object-learning-progress";
    case UPDATED_ORGANISATIONAL_UNIT = "updated-organisational-unit";
    case UPDATED_ROLE = "updated-role";
    case UPDATED_SCORM_LEARNING_MODULE = "updated-scorm-learning-module";
    case UPDATED_USER = "updated-user";
}
