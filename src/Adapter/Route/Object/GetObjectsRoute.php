<?php

namespace FluxIliasRestApi\Adapter\Route\Object;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Object\CustomObjectType;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
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
            null,
            [
                RouteParamDocumentationDto::new(
                    "types",
                    ObjectType::class . "[]",
                    "Filter by object types split by ,"
                ),
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
        return "/objects";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getObjects(
                    ($types = $request->getQueryParam(
                        "types"
                    )) !== null ? array_map(fn(string $type) : ObjectType => CustomObjectType::factory(
                        $type
                    ), explode(",", $types)) : null,
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
