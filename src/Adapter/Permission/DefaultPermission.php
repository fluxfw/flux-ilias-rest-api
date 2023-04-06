<?php

namespace FluxIliasRestApi\Adapter\Permission;

enum DefaultPermission: string implements Permission
{

    case ADD_NEWS = "add-news";
    case ADMINISTRATE_LOCAL_USER_ACCOUNTS = "administrate-local-user-accounts";
    case CHANGE_PERMISSIONS = "change-permissions";
    case COPY = "copy";
    case DELETE = "delete";
    case EDIT_CALENDAR = "edit-calendar";
    case EDIT_LEARNING_PROGRESS = "edit-learning-progress";
    case EDIT_ROLE_ASSIGNMENT = "edit-role-assignment";
    case EDIT_SETTINGS = "edit-settings";
    case EDIT_USER_ASSIGNMENT = "edit-user-assignment";
    case GRADE = "grade";
    case JOIN = "join";
    case MANAGE_MEMBERS = "manage-members";
    case READ = "read";
    case READ_ACCESS_TO_USER_ACCOUNTS = "read-access-to-user-accounts";
    case RECOMMEND_CONTENT = "recommend-content";
    case UNSUBSCRIBE = "unsubscribe";
    case VIEW_LEARNING_PROGRESS = "view-learning-progress";
    case VIEW_LEARNING_PROGRESS_OF_UNIT_INCL_SUBUNITS = "view-learning-progress-of-unit-incl-subunits";
    case VIEW_LEARNING_PROGRESS_OF_OTHER_USERS = "view-learning-progress-of-other-users";
    case VISIBLE = "visible";
}
