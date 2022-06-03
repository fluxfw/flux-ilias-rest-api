<?php

namespace FluxIliasRestApi\Adapter\Route\UserRole;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\UserRole\UserRoleDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;

class GetUserRolesRoute implements Route
{

    private IliasApi $ilias_api;


    private function __construct(
        /*private readonly*/ IliasApi $ilias_api
    ) {
        $this->ilias_api = $ilias_api;
    }


    public static function new(
        IliasApi $ilias_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_api
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Get user roles",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "role_id",
                    "int",
                    "Only users in role by id"
                ),
                RouteParamDocumentationDto::new(
                    "role_import_id",
                    "string",
                    "Only users in role by import id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "Only roles has user by id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "Only roles has user by import id"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::JSON(),
                    null,
                    UserRoleDto::class . "[]",
                    "User roles"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/user-roles";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_api->getUserRoles(
                    $request->getQueryParam(
                        "user_id"
                    ),
                    $request->getQueryParam(
                        "user_import_id"
                    ),
                    $request->getQueryParam(
                        "role_id"
                    ),
                    $request->getQueryParam(
                        "role_import_id"
                    )
                )
            )
        );
    }
}
