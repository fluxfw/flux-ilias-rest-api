<?php

namespace FluxIliasRestApi\Adapter\Route\Object;

use FluxIliasBaseApi\Adapter\Object\CustomObjectType;
use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Adapter\Api\IliasRestApi;
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

class GetObjectsRoute implements Route
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
            "Get objects",
            null,
            [
                RouteParamDocumentationDto::new(
                    "type",
                    ObjectType::class,
                    "Object type"
                )
            ],
            [
                RouteParamDocumentationDto::new(
                    "title",
                    "string",
                    "Filter by title"
                ),
                RouteParamDocumentationDto::new(
                    "ref_ids",
                    "bool",
                    "Include ref ids"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectDto::class . "[]",
                    "Objects"
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
        return "/objects/{type}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getObjects(
                    CustomObjectType::factory(
                        $request->getParam(
                            "type"
                        )
                    ),
                    $request->getQueryParam(
                        "title"
                    ),
                    $request->getQueryParam(
                        "ref_ids"
                    ) === "true",
                    false
                )
            )
        );
    }
}
