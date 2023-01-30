<?php

namespace FluxIliasRestApi\Adapter\Server;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Authorization\IliasAuthorization;
use FluxRestApi\Adapter\Api\RestApi;
use FluxRestApi\Adapter\Authorization\Authorization;
use FluxRestApi\Adapter\Route\Collector\RouteCollector;

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
        $ilias_rest_api = IliasRestApi::new();

        return new static(
            RestApi::new(),
            IliasRestApiServerRouteCollector::new(
                $ilias_rest_api
            ),
            IliasAuthorization::new(
                $ilias_rest_api
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
