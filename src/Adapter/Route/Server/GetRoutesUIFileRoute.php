<?php

namespace FluxIliasRestApi\Adapter\Route\Server;

use FluxIliasRestApi\Adapter\Body\Type\CustomBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetRoutesUIFileRoute implements Route
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
            "Get routes UI file",
            null,
            [
                RouteParamDocumentationDto::new(
                    "path",
                    "string",
                    "File path"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    CustomBodyType::factory(
                        "*"
                    ),
                    null,
                    null,
                    "Routes UI file"

                ),
                RouteResponseDocumentationDto::new(
                    null,
                    DefaultStatus::_404,
                    null,
                    "Routes UI file not found"
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
        return "/routes/ui/{path.}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $path = $request->getParam(
                "path"
            );

        if (file_exists(__DIR__ . "/../../UI/Route/" . $path)) {
            return ServerResponseDto::new(
                null,
                null,
                null,
                null,
                "/internal/flux-ilias-rest-api/routes-ui/" . $path
            );
        } else {
            return ServerResponseDto::new(
                null,
                DefaultStatus::_404
            );
        }
    }
}
