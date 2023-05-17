<?php

namespace FluxIliasRestApi\Service\Config;

enum ConfigKey: string
{

    case API_PROXY_MAP = "api_proxy_map";
    case ENABLE_LOG_CHANGES = "enable_log_changes";
    case ENABLE_PURGE_CHANGES = "enable_purge_changes";
    case ENABLE_REST_API = "enable_rest_api";
    case ENABLE_TRANSFER_CHANGES = "enable_transfer_changes";
    case FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS = "flux_ilias_rest_object_api_proxy_maps";
    case FLUX_ILIAS_REST_OBJECT_DEFAULT_ICON_URL = "flux_ilias_rest_object_default_icon_url";
    case FLUX_ILIAS_REST_OBJECT_MULTIPLE_TYPE_TITLE = "flux_ilias_rest_object_multiple_type_title";
    case FLUX_ILIAS_REST_OBJECT_TYPE_TITLE = "flux_ilias_rest_object_type_title";
    case FLUX_ILIAS_REST_OBJECT_WEB_PROXY_MAPS = "flux_ilias_rest_object_web_proxy_maps";
    case KEEP_CHANGES_INSIDE_DAYS = "keep_changes_inside_days";
    case LAST_TRANSFERRED_CHANGE_TIME = "last_transferred_change_time";
    case PURGE_CHANGES_SCHEDULE = "purge_changes_schedule";
    case REST_API_USER_LOGIN = "rest_api_user_login";
    case TRANSFER_CHANGES_PASSWORD = "transfer_changes_password";
    case TRANSFER_CHANGES_POST_URL = "transfer_changes_post_url";
    case TRANSFER_CHANGES_SCHEDULE = "transfer_changes_schedule";
    case TRANSFER_CHANGES_USER = "transfer_changes_user";
    case WEB_PROXY_IFRAME_HEIGHT_OFFSET = "web_proxy_iframe_height_offset";
    case WEB_PROXY_MAP = "web_proxy_map";
}
