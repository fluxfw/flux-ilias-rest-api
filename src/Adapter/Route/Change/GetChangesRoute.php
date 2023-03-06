<?php

namespace FluxIliasRestApi\Adapter\Route\Change;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Change\ChangeDto;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;

class GetChangesRoute implements Route
{

    private function __construct(
        private readonly IliasRestApi $ilias_rest_api
    ) {

    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : static {
        return new static(
            $ilias_rest_api
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Get changes",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "after",
                    "float",
                    "Only changes after timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "before",
                    "float",
                    "Only changes before timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "from",
                    "float",
                    "Only changes from timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "to",
                    "float",
                    "Only changes to timestamp"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ChangeDto::class . "[]",
                    "Changes"
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
        return "/changes";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getChanges(
                    $request->getQueryParam(
                        "from"
                    ),
                    $request->getQueryParam(
                        "to"
                    ),
                    $request->getQueryParam(
                        "after"
                    ),
                    $request->getQueryParam(
                        "before"
                    )
                )
            )
        );
    }
}
