<?php

namespace FluxIliasRestApi\Service\Proxy;

enum ProxyTarget: string
{

    case API_PROXY = "flilre_api_proxy_";
    case CONFIG = "flilre_config";
    case LOGIN = "flilre_login";
    case OBJECT_API_PROXY = "flilre_object_api_proxy_";
    case OBJECT_CONFIG = "flilre_object_config_";
    case OBJECT_WEB_PROXY = "flilre_object_web_proxy_";
    case WEB_PROXY = "flilre_web_proxy_";
}
