<?php

namespace FluxIliasRestApi;

require_once __DIR__ . "/../libs/flux-autoload-api/autoload.php";
require_once __DIR__ . "/../libs/flux-legacy-enum/autoload.php";
require_once __DIR__ . "/../libs/flux-rest-api/autoload.php";

use FluxIliasRestApi\Libs\FluxAutoloadApi\Adapter\Autoload\Psr4Autoload;
use FluxIliasRestApi\Libs\FluxAutoloadApi\Adapter\Checker\PhpExtChecker;
use FluxIliasRestApi\Libs\FluxAutoloadApi\Adapter\Checker\PhpVersionChecker;

PhpVersionChecker::new(
    ">=7.4"
)
    ->checkAndDie(
        __NAMESPACE__
    );
PhpExtChecker::new(
    [
        "curl",
        "json"
    ]
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
