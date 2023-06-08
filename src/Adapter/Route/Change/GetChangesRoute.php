<?php

namespace FluxIliasRestApi\Adapter\Route\Change;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Change\ChangeDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

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
                    "time",
                    "float",
                    "Only changes on timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "time_from",
                    "float",
                    "Only changes from timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "time_to",
                    "float",
                    "Only changes to timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "time_after",
                    "float",
                    "Only changes after timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "time_before",
                    "float",
                    "Only changes before timestamp"
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
                        "time"
                    ),
                    $request->getQueryParam(
                        "time_from"
                    ),
                    $request->getQueryParam(
                        "time_to"
                    ),
                    $request->getQueryParam(
                        "time_after"
                    ),
                    $request->getQueryParam(
                        "time_before"
                    )
                )
            )
        );
    }
}
