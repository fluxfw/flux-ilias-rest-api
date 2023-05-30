<?php

namespace FluxIliasRestApi\Adapter\Route\UserRole;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\UserRole\UserRoleDto;

class GetUserRolesRoute implements Route
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
                    DefaultBodyType::JSON,
                    null,
                    UserRoleDto::class . "[]",
                    "User roles"
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
        return "/user-roles";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getUserRoles(
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
