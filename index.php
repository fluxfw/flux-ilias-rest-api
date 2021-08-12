<?php

require_once __DIR__ . "/vendor/autoload.php";

use Fluxlabs\FluxIliasRestApi\Authorization\IliasAuthorization;
use Fluxlabs\FluxIliasRestApi\Route\Collector\IliasPluginsRouteCollector;
use Fluxlabs\FluxRestApi\Handler\DefaultHandler;
use Fluxlabs\FluxRestApi\Route\Collector\CombinedRouteCollector;
use Fluxlabs\FluxRestApi\Route\Collector\FolderRouteCollector;

DefaultHandler::new(
    CombinedRouteCollector::new(
        [
            FolderRouteCollector::new(
                __DIR__ . "/routes"
            ),
            IliasPluginsRouteCollector::new()
        ]
    ),
    IliasAuthorization::new()
)
    ->handle();
