<?php

namespace Fluxlabs\FluxIliasRestApi\Config;

use Fluxlabs\FluxIliasRestApi\Authorization\IliasAuthorization;
use Fluxlabs\FluxIliasRestApi\Route\Fetcher\IliasPluginsRoutesFetcher;
use Fluxlabs\FluxRestApi\Authorization\Authorization;
use Fluxlabs\FluxRestApi\Config\Config;
use Fluxlabs\FluxRestApi\Route\Fetcher\CombinedRoutesFetcher;
use Fluxlabs\FluxRestApi\Route\Fetcher\FolderRoutesFetcher;
use Fluxlabs\FluxRestApi\Route\Fetcher\RoutesFetcher;

class IliasConfig implements Config
{

    private static ?self $instance = null;
    private ?Authorization $authorization = null;
    private ?RoutesFetcher $routes_fetcher = null;


    public static function new() : /*static*/ self
    {
        static::$instance ??= new static();

        return static::$instance;
    }


    public function getAuthorization() : Authorization
    {
        $this->authorization ??= IliasAuthorization::new();

        return $this->authorization;
    }


    public function getRoutesFetcher() : RoutesFetcher
    {
        $this->routes_fetcher ??= CombinedRoutesFetcher::new(
            [
                FolderRoutesFetcher::new(
                    __DIR__ . "/../../routes"
                ),
                IliasPluginsRoutesFetcher::new()
            ]
        );

        return $this->routes_fetcher;
    }
}
