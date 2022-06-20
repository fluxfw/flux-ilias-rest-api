<?php

namespace FluxIliasRestApi;

require_once __DIR__ . "/../libs/flux-autoload-api/autoload.php";
require_once __DIR__ . "/../libs/flux-ilias-api/autoload.php";
require_once __DIR__ . "/../libs/flux-rest-api/autoload.php";

use FluxIliasRestApi\Libs\FluxAutoloadApi\Adapter\Autoload\Psr4Autoload;
use FluxIliasRestApi\Libs\FluxAutoloadApi\Adapter\Checker\PhpVersionChecker;

PhpVersionChecker::new(
    ">=8.1"
)
    ->checkAndDie(
        __NAMESPACE__
    );

Psr4Autoload::new(
    [
        __NAMESPACE__ => __DIR__
    ]
)
    ->autoload();
