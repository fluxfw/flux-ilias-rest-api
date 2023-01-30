<?php

namespace FluxIliasRestApi\Adapter\Route\Object\GetPath;

use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\TextBodyDto;
use FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxRestApi\Adapter\Status\DefaultStatus;

class GetPathByIdRoute implements Route
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
            "Get tree path of object by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Object id"
                )
            ],
            [
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
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Object not found"
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
        return "/object/path/by-id/{id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $path = $this->ilias_rest_api->getPathById(
            $request->getParam(
                "id"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true",
            false
        );

        if ($path !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $path
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Object not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
