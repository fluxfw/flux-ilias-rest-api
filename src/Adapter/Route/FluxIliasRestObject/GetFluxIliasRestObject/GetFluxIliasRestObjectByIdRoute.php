<?php

namespace FluxIliasRestApi\Adapter\Route\FluxIliasRestObject\GetFluxIliasRestObject;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetFluxIliasRestObjectByIdRoute implements Route
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
            "Get flux-ilias-rest-object by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "flux-ilias-rest-object id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    FluxIliasRestObjectDto::class,
                    "flux-ilias-rest-object"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "flux-ilias-rest-object not found"
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
        return "/flux-ilias-rest-object/by-id/{id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $object = $this->ilias_rest_api->getFluxIliasRestObjectById(
            $request->getParam(
                "id"
            ),
            false
        );

        if ($object !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $object
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "flux-ilias-rest-object not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
