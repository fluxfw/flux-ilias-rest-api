<?php

namespace FluxIliasRestApi\Adapter\Route\Object;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Permission\CustomPermission;
use FluxIliasRestApi\Libs\FluxIliasApi\Libs\FluxIliasBaseApi\Adapter\Permission\Permission;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;

class HasAccessByRefIdByUserIdRoute implements Route
{

    private function __construct(
        private readonly IliasApi $ilias_api
    ) {

    }


    public static function new(
        IliasApi $ilias_api
    ) : static {
        return new static(
            $ilias_api
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
                $this->ilias_api->hasAccessByRefIdByUserId(
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
