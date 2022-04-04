<?php

namespace FluxIliasRestApi\Adapter\Server;

use FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use FluxIliasRestApi\Adapter\Collector\IliasPluginsRouteCollector;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Collector\CombinedRouteCollector;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Collector\FolderRouteCollector;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\DefaultRestApiServer;

class IliasRestApiServer
{

    private DefaultRestApiServer $default_rest_api_server;


    private function __construct(
        /*private readonly*/ DefaultRestApiServer $default_rest_api_server
    ) {
        $this->default_rest_api_server = $default_rest_api_server;
    }


    public static function new() : /*static*/ self
    {
        return new static(
            DefaultRestApiServer::new(
                CombinedRouteCollector::new(
                    [
                        IliasRestApiServerRouteCollector::new(
                            IliasApi::new()
                        ),
                        FolderRouteCollector::new(
                            __DIR__ . "/../routes"
                        ),
                        IliasPluginsRouteCollector::new()
                    ]
                ),
                IliasAuthorization::new()
            )
        );
    }


    public function handle() : void
    {
        $this->default_rest_api_server->handle();
    }
}
