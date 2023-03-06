<?php

namespace FluxIliasRestApi\Service\Permission;

use FluxIliasRestApi\Adapter\Permission\CustomPermission;
use FluxIliasRestApi\Adapter\Permission\DefaultPermission;
use FluxIliasRestApi\Adapter\Permission\Permission;

class PermissionMapping
{

    public static function mapExternalToInternal(Permission $permission) : InternalPermission
    {
        return CustomInternalPermission::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$permission->value] ?? substr($permission->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalPermission $permission) : Permission
    {
        return CustomPermission::factory(
            static::INTERNAL_EXTERNAL()[$permission->value] ?? "_" . $permission->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            DefaultInternalPermission::CAT_ADMINISTRATE_USERS->value     => DefaultPermission::ADMINISTRATE_LOCAL_USER_ACCOUNTS->value,
            DefaultInternalPermission::COPY->value                       => DefaultPermission::COPY->value,
            DefaultInternalPermission::DELETE->value                     => DefaultPermission::DELETE->value,
            DefaultInternalPermission::EDIT_EVENT->value                 => DefaultPermission::EDIT_CALENDAR->value,
            DefaultInternalPermission::EDIT_LEARNING_PROGRESS->value     => DefaultPermission::EDIT_LEARNING_PROGRESS->value,
            DefaultInternalPermission::EDIT_MEMBERS->value               => DefaultPermission::MANAGE_MEMBERS->value,
            DefaultInternalPermission::EDIT_PERMISSION->value            => DefaultPermission::CHANGE_PERMISSIONS->value,
            DefaultInternalPermission::EDIT_ROLEASSIGNMENT->value        => DefaultPermission::EDIT_ROLE_ASSIGNMENT->value,
            DefaultInternalPermission::EDIT_USERASSIGNMENT->value        => DefaultPermission::EDIT_USER_ASSIGNMENT->value,
            DefaultInternalPermission::GRADE->value                      => DefaultPermission::GRADE->value,
            DefaultInternalPermission::JOIN->value                       => DefaultPermission::JOIN->value,
            DefaultInternalPermission::LEAVE->value                      => DefaultPermission::UNSUBSCRIBE->value,
            DefaultInternalPermission::NEWS_ADD_NEWS->value              => DefaultPermission::ADD_NEWS->value,
            DefaultInternalPermission::PUSH_DESKTOP_ITEMS->value         => DefaultPermission::RECOMMEND_CONTENT->value,
            DefaultInternalPermission::READ->value                       => DefaultPermission::READ->value,
            DefaultInternalPermission::READ_LEARNING_PROGRESS->value     => DefaultPermission::VIEW_LEARNING_PROGRESS_OF_OTHER_USERS->value,
            DefaultInternalPermission::READ_USERS->value                 => DefaultPermission::READ_ACCESS_TO_USER_ACCOUNTS->value,
            DefaultInternalPermission::VIEW_LEARNING_PROGRESS->value     => DefaultPermission::VIEW_LEARNING_PROGRESS->value,
            DefaultInternalPermission::VIEW_LEARNING_PROGRESS_REC->value => DefaultPermission::VIEW_LEARNING_PROGRESS_OF_UNIT_INCL_SUBUNITS->value,
            DefaultInternalPermission::VISIBLE->value                    => DefaultPermission::VISIBLE->value,
            DefaultInternalPermission::WRITE->value                      => DefaultPermission::EDIT_SETTINGS->value
        ];
    }
}
