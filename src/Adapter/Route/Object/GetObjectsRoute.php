<?php

namespace FluxIliasRestApi\Adapter\Route\Object;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Object\CustomObjectType;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

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
                    "id",
                    "int",
                    "Filter object to id"
                ),
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Filter object to import id"
                ),
                RouteParamDocumentationDto::new(
                    "ref_id",
                    "int",
                    "Filter object to ref id"
                ),
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
                    $request->getQueryParam(
                        "id"
                    ),
                    $request->getQueryParam(
                        "import_id"
                    ),
                    $request->getQueryParam(
                        "ref_id"
                    ),
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
