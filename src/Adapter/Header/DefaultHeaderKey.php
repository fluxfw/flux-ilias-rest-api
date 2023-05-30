<?php

namespace FluxIliasRestApi\Adapter\Header;

enum DefaultHeaderKey: string implements HeaderKey
{

    case ACCEPT = "accept";
    case AUTHORIZATION = "authorization";
    case CONTENT_DISPOSITION = "content-disposition";
    case CONTENT_TYPE = "content-type";
    case LOCATION = "location";
    case USER_AGENT = "user-agent";
    case WWW_AUTHENTICATE = "www-authenticate";
    case X_ACCEL_REDIRECT = "x-accel-redirect";
    case X_SENDFILE = "x-sendfile";
}
