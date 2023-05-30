<?php

namespace FluxIliasRestApi\Adapter\Cookie\SameSite;

enum CookieSameSite: string
{

    case LAX = "Lax";
    case NONE = "None";
    case STRICT = "Strict";
}
