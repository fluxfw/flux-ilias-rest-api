<?php

namespace FluxIliasRestApi\Adapter\Collector;

use FluxRestApi\Adapter\Collector\FolderRouteCollector;
use FluxRestApi\Collector\RouteCollector;
use ilPluginAdmin;
use Throwable;

class IliasPluginsRouteCollector implements RouteCollector
{

    public static function new() : /*static*/ self
    {
        $collector = new static();

        return $collector;
    }


    public function collectRoutes() : array
    {
        return array_reduce(ilPluginAdmin::getActivePlugins(), function (array $routes, array $plugin_data) : array {
            $plugin = null;
            try {
                $plugin = ilPluginAdmin::getPluginObject($plugin_data["component_type"], $plugin_data["component_name"], $plugin_data["slot_id"], $plugin_data["name"]);
            } catch (Throwable $ex) {
            }

            if ($plugin === null || !$plugin->isActive()) {
                return $routes;
            }

            $plugin_routes_folder = $plugin->getDirectory() . "/src/Adapter/Route";
            if (!file_exists($plugin_routes_folder)) {
                return $routes;
            }

            if (file_exists($plugin_autoload_file = $plugin->getDirectory() . "/autoload.php") || file_exists($plugin_autoload_file = $plugin->getDirectory() . "/vendor/autoload.php")) {
                require_once $plugin_autoload_file;
            }

            return array_merge($routes, FolderRouteCollector::new(
                $plugin_routes_folder
            )
                ->collectRoutes());
        }, []);
    }
}
