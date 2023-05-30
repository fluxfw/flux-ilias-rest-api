<?php

namespace FluxIliasRestApi\Service\Rest\Port;

use FluxIliasRestApi\Adapter\Authorization\Authorization;
use FluxIliasRestApi\Adapter\Body\BodyDto;
use FluxIliasRestApi\Adapter\Body\RawBodyDto;
use FluxIliasRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasRestApi\Adapter\Client\ClientResponseDto;
use FluxIliasRestApi\Adapter\Route\Collector\RouteCollector;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasRestApi\Service\Body\Port\BodyService;
use FluxIliasRestApi\Service\Client\Port\ClientService;
use FluxIliasRestApi\Service\Server\Port\ServerService;

class RestService
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getDefaultRequest() : ServerRawRequestDto
    {
        return $this->getBodyService()
            ->getDefaultRequest();
    }


    public function handleDefaultRequest(RouteCollector $route_collector, ?Authorization $authorization = null) : void
    {
        $this->getServerService(
            $route_collector,
            $authorization
        )
            ->handleDefaultRequest();
    }


    public function handleDefaultResponse(ServerRawResponseDto $response) : void
    {
        $this->getBodyService()
            ->handleDefaultResponse(
                $response
            );
    }


    public function handleRequest(ServerRawRequestDto $request, RouteCollector $route_collector, ?Authorization $authorization = null, bool $routes_ui = false) : ServerRawResponseDto
    {
        return $this->getServerService(
            $route_collector,
            $authorization
        )
            ->handleRequest(
                $request,
                $routes_ui
            );
    }


    public function makeRequest(ClientRequestDto $request) : ?ClientResponseDto
    {
        return $this->getClientService()
            ->makeRequest(
                $request
            );
    }


    public function parseBody(RawBodyDto $body, ?array $post = null, ?array $files = null) : ?BodyDto
    {
        return $this->getBodyService()
            ->parseBody(
                $body,
                $post,
                $files
            );
    }


    public function toRawBody(BodyDto $body) : RawBodyDto
    {
        return $this->getBodyService()
            ->toRawBody(
                $body
            );
    }


    private function getBodyService() : BodyService
    {
        return BodyService::new();
    }


    private function getClientService() : ClientService
    {
        return ClientService::new(
            $this->getBodyService()
        );
    }


    private function getServerService(RouteCollector $route_collector, ?Authorization $authorization = null) : ServerService
    {
        return ServerService::new(
            $this->getBodyService(),
            $route_collector,
            $authorization
        );
    }
}
