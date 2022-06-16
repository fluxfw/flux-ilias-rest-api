<?php

namespace FluxIliasRestApi\Adapter\Server;

use FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Authorization\Authorization;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Collector\RouteCollector;

class IliasRestApiServer
{

    private function __construct(
        private readonly RestApi $rest_api,
        private readonly RouteCollector $route_collector,
        private readonly Authorization $authorization
    ) {

    }


    public static function new() : static
    {
        $ilias_api = IliasApi::new();

        return new static(
            RestApi::new(),
            IliasRestApiServerRouteCollector::new(
                $ilias_api
            ),
            IliasAuthorization::new(
                $ilias_api
            )
        );
    }


    public function handle() : void
    {
        $this->rest_api->handleDefaultRequest(
            $this->route_collector,
            $this->authorization
        );
    }
}
