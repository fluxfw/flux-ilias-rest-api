<?php

namespace FluxIliasRestApi\Adapter\Route\Object\CloneObject;

use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
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

class CloneObjectByIdToIdRoute implements Route
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
            "Clone object by id to object by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Object id"
                ),
                RouteParamDocumentationDto::new(
                    "parent_id",
                    "int",
                    "Parent object id"
                )
            ],
            [
                RouteParamDocumentationDto::new(
                    "link",
                    "bool",
                    "Link childrens if clone is not possible"
                ),
                RouteParamDocumentationDto::new(
                    "prefer_link",
                    "bool",
                    "Prefer link childrens to clone if possible"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectIdDto::class,
                    "Object ids"
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
        return DefaultMethod::POST;
    }


    public function getRoute() : string
    {
        return "/object/by-id/{id}/clone/to-id/{parent_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_rest_api->cloneObjectByIdToId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "parent_id"
            ),
            $request->getQueryParam(
                "link"
            ) === "true",
            $request->getQueryParam(
                "prefer_link"
            ) === "true"
        );

        if ($id !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $id
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
