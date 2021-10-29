<?php

require_once __DIR__ . "/../vendor/autoload.php";

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use FluxIliasRestApi\Adapter\Collector\IliasPluginsRouteCollector;
use FluxRestApi\Adapter\Collector\CombinedRouteCollector;
use FluxRestApi\Adapter\Collector\FolderRouteCollector;
use FluxRestApi\Adapter\Handler\DefaultHandler;

DefaultHandler::new(
    CombinedRouteCollector::new(
        [
            FolderRouteCollector::new(
                __DIR__ . "/../src/Adapter/Route",
                [
                    Api::new()
                ]
            ),
            FolderRouteCollector::new(
                __DIR__ . "/../routes"
            ),
            IliasPluginsRouteCollector::new()
        ]
    ),
    IliasAuthorization::new()
)
    ->handle();
