<?php

namespace Fluxlabs\FluxIliasRestApi\Config;

use Fluxlabs\FluxIliasRestApi\Authorization\IliasAuthorization;
use Fluxlabs\FluxIliasRestApi\Route\Collector\IliasPluginsRouteCollector;
use Fluxlabs\FluxRestApi\Authorization\Authorization;
use Fluxlabs\FluxRestApi\Config\Config;
use Fluxlabs\FluxRestApi\Route\Collector\CombinedRouteCollector;
use Fluxlabs\FluxRestApi\Route\Collector\FolderRouteCollector;
use Fluxlabs\FluxRestApi\Route\Collector\RouteCollector;

class IliasConfig implements Config
{

    private static ?self $instance = null;
    private ?Authorization $authorization = null;
    private ?RouteCollector $route_collector = null;


    public static function new() : /*static*/ self
    {
        static::$instance ??= new static();

        return static::$instance;
    }


    public function getAuthorization() : ?Authorization
    {
        $this->authorization ??= IliasAuthorization::new();

        return $this->authorization;
    }


    public function getRouteCollector() : RouteCollector
    {
        $this->route_collector ??= CombinedRouteCollector::new(
            [
                FolderRouteCollector::new(
                    __DIR__ . "/../../routes"
                ),
                IliasPluginsRouteCollector::new()
            ]
        );

        return $this->route_collector;
    }
}
