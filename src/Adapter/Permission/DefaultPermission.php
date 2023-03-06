<?php

namespace FluxIliasRestApi\Adapter\Permission;

enum DefaultPermission: string implements Permission
{

    case ADD_NEWS = "add_news";
    case ADMINISTRATE_LOCAL_USER_ACCOUNTS = "administrate_local_user_accounts";
    case CHANGE_PERMISSIONS = "change_permissions";
    case COPY = "copy";
    case DELETE = "delete";
    case EDIT_CALENDAR = "edit_calendar";
    case EDIT_LEARNING_PROGRESS = "edit_learning_progress";
    case EDIT_ROLE_ASSIGNMENT = "edit_role_assignment";
    case EDIT_SETTINGS = "edit_settings";
    case EDIT_USER_ASSIGNMENT = "edit_user_assignment";
    case GRADE = "grade";
    case JOIN = "join";
    case MANAGE_MEMBERS = "manage_members";
    case READ = "read";
    case READ_ACCESS_TO_USER_ACCOUNTS = "read_access_to_user_accounts";
    case RECOMMEND_CONTENT = "recommend_content";
    case UNSUBSCRIBE = "unsubscribe";
    case VIEW_LEARNING_PROGRESS = "view_learning_progress";
    case VIEW_LEARNING_PROGRESS_OF_UNIT_INCL_SUBUNITS = "view_learning_progress_of_unit_incl_subunits";
    case VIEW_LEARNING_PROGRESS_OF_OTHER_USERS = "view_learning_progress_of_other_users";
    case VISIBLE = "visible";
}
