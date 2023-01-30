<?php

namespace FluxIliasRestApi\Service\Permission;

enum DefaultInternalPermission: string implements InternalPermission
{

    case CAT_ADMINISTRATE_USERS = "cat_administrate_users";
    case COPY = "copy";
    case DELETE = "delete";
    case EDIT_EVENT = "edit_event";
    case EDIT_LEARNING_PROGRESS = "edit_learning_progress";
    case EDIT_MEMBERS = "edit_members";
    case EDIT_PERMISSION = "edit_permission";
    case EDIT_ROLEASSIGNMENT = "edit_roleassignment";
    case EDIT_USERASSIGNMENT = "edit_userassignment";
    case GRADE = "grade";
    case JOIN = "join";
    case LEAVE = "leave";
    case NEWS_ADD_NEWS = "news_add_news";
    case PUSH_DESKTOP_ITEMS = "push_desktop_items";
    case READ = "read";
    case READ_LEARNING_PROGRESS = "read_learning_progress";
    case READ_USERS = "read_users";
    case VIEW_LEARNING_PROGRESS = "view_learning_progress";
    case VIEW_LEARNING_PROGRESS_REC = "view_learning_progress_rec";
    case VISIBLE = "visible";
    case WRITE = "write";
}
