<?php

namespace FluxIliasRestApi\Adapter\Route\Server;

use FluxIliasRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetDefaultRoute implements Route
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Redirect to routes UI",
            null,
            null,
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    null,
                    DefaultStatus::_302,
                    null,
                    "Redirect to routes/ui"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            null,
            DefaultStatus::_302,
            [
                DefaultHeaderKey::LOCATION->value => rtrim($request->original_route, "/") . "/routes/ui"
            ]
        );
    }
}
