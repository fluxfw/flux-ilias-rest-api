<?php

namespace FluxIliasRestApi\Adapter\Status;

enum DefaultStatus: int implements Status
{

    case _200 = 200;
    case _201 = 201;
    case _302 = 302;
    case _400 = 400;
    case _401 = 401;
    case _403 = 403;
    case _404 = 404;
    case _405 = 405;
    case _500 = 500;
}
