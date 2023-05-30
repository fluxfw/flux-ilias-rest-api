<?php

namespace FluxIliasRestApi\Adapter\Body\Type;

enum DefaultBodyType: string implements BodyType
{

    case FORM_DATA = "application/x-www-form-urlencoded";
    case FORM_DATA_2 = "multipart/form-data";
    case HTML = "text/html";
    case JSON = "application/json";
    case TEXT = "text/plain";
}
