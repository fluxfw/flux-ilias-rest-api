<?php

namespace FluxIliasRestApi\Service\Server\Port;

use FluxIliasRestApi\Adapter\Authorization\Authorization;
use FluxIliasRestApi\Adapter\Route\Collector\RouteCollector;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasRestApi\Service\Body\Port\BodyService;
use FluxIliasRestApi\Service\Server\Command\HandleDefaultRequestCommand;
use FluxIliasRestApi\Service\Server\Command\HandleRequestCommand;

class ServerService
{

    private function __construct(
        private readonly BodyService $body_service,
        private readonly RouteCollector $route_collector,
        private readonly ?Authorization $authorization
    ) {

    }


    public static function new(
        BodyService $body_service,
        RouteCollector $route_collector,
        ?Authorization $authorization = null
    ) : static {
        return new static(
            $body_service,
            $route_collector,
            $authorization
        );
    }


    public function handleDefaultRequest() : void
    {
        HandleDefaultRequestCommand::new(
            $this,
            $this->body_service
        )
            ->handleDefaultRequest();
    }


    public function handleRequest(ServerRawRequestDto $request, bool $routes_ui = false) : ServerRawResponseDto
    {
        return HandleRequestCommand::new(
            $this->body_service,
            $this->route_collector,
            $this->authorization,
            $routes_ui
        )
            ->handleRequest(
                $request
            );
    }
}
