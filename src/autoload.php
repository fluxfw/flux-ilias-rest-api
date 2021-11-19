<?php

namespace FluxIliasRestApi;

require_once __DIR__ . "/../libs/flux-rest-api/autoload.php";

use FluxAutoloadApi\Adapter\Autoload\Psr4Autoload;
use FluxAutoloadApi\Adapter\Checker\PhpExtChecker;
use FluxAutoloadApi\Adapter\Checker\PhpVersionChecker;

PhpVersionChecker::new(
    ">=7.4",
    __NAMESPACE__
)
    ->check();
PhpExtChecker::new(
    [
        "json"
    ],
    __NAMESPACE__
)
    ->check();

Psr4Autoload::new(
    [
        __NAMESPACE__ => __DIR__
    ]
)
    ->autoload();
