<?php

namespace Fluxlabs\FluxIliasRestApi\Route\Fetcher;

use Fluxlabs\FluxRestApi\Route\Fetcher\FolderRoutesFetcher;
use Fluxlabs\FluxRestApi\Route\Fetcher\RoutesFetcher;
use ilPluginAdmin;
use Throwable;

class IliasPluginsRoutesFetcher implements RoutesFetcher
{

    public static function new() : /*static*/ self
    {
        $fetcher = new static();

        return $fetcher;
    }


    public function fetchRoutes() : array
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

            $plugin_routes_folder = $plugin->getDirectory() . "/routes";
            if (!file_exists($plugin_routes_folder)) {
                return $routes;
            }

            $plugin_autoload_file = $plugin->getDirectory() . "/vendor/autoload.php";
            if (file_exists($plugin_autoload_file)) {
                require_once $plugin_autoload_file;
            }

            return array_merge($routes, FolderRoutesFetcher::new(
                $plugin_routes_folder
            )
                ->fetchRoutes());
        }, []);
    }
}
