<?php

namespace FluxIliasRestApi\Adapter\Route\Collector;

use FluxIliasRestApi\Adapter\Route\Route;
use LogicException;

class CombinedRouteCollector implements RouteCollector
{

    /**
     * @param RouteCollector[]|Route[] $route_collectors
     */
    private function __construct(
        private readonly array $route_collectors
    ) {

    }


    /**
     * @param RouteCollector[]|Route[] $route_collectors
     */
    public static function new(
        array $route_collectors
    ) : static {
        return new static(
            $route_collectors
        );
    }


    public function collectRoutes() : array
    {
        return array_reduce($this->route_collectors, function (array $routes, RouteCollector|Route $route_collector) : array {
            switch (true) {
                case $route_collector instanceof RouteCollector:
                    $routes = array_merge($routes, $route_collector->collectRoutes());
                    break;

                case $route_collector instanceof Route:
                    $routes[] = $route_collector;
                    break;

                default:
                    throw new LogicException(get_class($route_collector) . " is not supported");
            }

            return $routes;
        }, []);
    }
}
