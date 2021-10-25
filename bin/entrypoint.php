<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use Fluxlabs\FluxIliasRestApi\Adapter\Collector\IliasPluginsRouteCollector;
use Fluxlabs\FluxRestApi\Adapter\Collector\CombinedRouteCollector;
use Fluxlabs\FluxRestApi\Adapter\Collector\FolderRouteCollector;
use Fluxlabs\FluxRestApi\Adapter\Handler\DefaultHandler;

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
