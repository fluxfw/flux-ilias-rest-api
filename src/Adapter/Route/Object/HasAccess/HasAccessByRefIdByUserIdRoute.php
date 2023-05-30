<?php

namespace FluxIliasRestApi\Adapter\Route\Object\HasAccess;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Permission\CustomPermission;
use FluxIliasRestApi\Adapter\Permission\Permission;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

class HasAccessByRefIdByUserIdRoute implements Route
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
            "Has user permission in object",
            null,
            [
                RouteParamDocumentationDto::new(
                    "ref_id",
                    "int",
                    "Object ref id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "User id"
                ),
                RouteParamDocumentationDto::new(
                    "permission",
                    Permission::class,
                    "Permission"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    "bool",
                    "Has access"
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
        return "/object/by-ref-id/{ref_id}/has-access/by-id/{user_id}/{permission}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->hasAccessByRefIdByUserId(
                    $request->getParam(
                        "ref_id"
                    ),
                    $request->getParam(
                        "user_id"
                    ),
                    CustomPermission::factory(
                        $request->getParam(
                            "permission"
                        )
                    )
                )
            )
        );
    }
}
