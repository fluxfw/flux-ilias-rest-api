<?php

require_once __DIR__ . "/../autoload.php";

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use FluxIliasRestApi\Adapter\Collector\IliasPluginsRouteCollector;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Collector\CombinedRouteCollector;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Collector\FolderRouteCollector;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Handler\DefaultHandler;

DefaultHandler::new(
    CombinedRouteCollector::new(
        [
            FolderRouteCollector::new(
                __DIR__ . "/../src/Adapter/Route",
                [
                    IliasRestApi::new()
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
