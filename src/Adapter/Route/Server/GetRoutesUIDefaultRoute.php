<?php

namespace FluxIliasRestApi\Adapter\Route\Server;

use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetRoutesUIDefaultRoute implements Route
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
            "Routes UI",
            null,
            null,
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::HTML,
                    null,
                    null,
                    "Routes UI"
                ),
                RouteResponseDocumentationDto::new(
                    null,
                    DefaultStatus::_302,
                    null,
                    "Redirect if has trailing / and remove it"
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
        return "/routes/ui";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (str_ends_with($request->original_route, "/")) {
            return ServerResponseDto::new(
                null,
                DefaultStatus::_302,
                [
                    DefaultHeaderKey::LOCATION->value => rtrim($request->original_route, "/")
                ]
            );
        }

        $path = "index.html";

        return ServerResponseDto::new(
            null,
            null,
            null,
            null,
            "/internal/flux-ilias-rest-api/routes-ui/" . $path
        );
    }
}
