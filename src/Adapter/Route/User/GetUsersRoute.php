<?php

namespace FluxIliasRestApi\Adapter\Route\User;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\User\UserDto;
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

class GetUsersRoute implements Route
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
            "Get users",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "external_account",
                    "string",
                    "Filter by external account"
                ),
                RouteParamDocumentationDto::new(
                    "login",
                    "string",
                    "Filter by login"
                ),
                RouteParamDocumentationDto::new(
                    "email",
                    "string",
                    "Filter by email"
                ),
                RouteParamDocumentationDto::new(
                    "matriculation_number",
                    "string",
                    "Filter by matriculation number"
                ),
                RouteParamDocumentationDto::new(
                    "access_limited_object_ids",
                    "bool",
                    "Include access limited objects ids"
                ),
                RouteParamDocumentationDto::new(
                    "multi_fields",
                    "bool",
                    "Include multi fields"
                ),
                RouteParamDocumentationDto::new(
                    "preferences",
                    "bool",
                    "Include preferences"
                ),
                RouteParamDocumentationDto::new(
                    "user_defined_fields",
                    "bool",
                    "Include user defined fields"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    UserDto::class . "[]",
                    "Users"
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
        return "/users";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getUsers(
                    $request->getQueryParam(
                        "external_account"
                    ),
                    $request->getQueryParam(
                        "login"
                    ),
                    $request->getQueryParam(
                        "email"
                    ),
                    $request->getQueryParam(
                        "matriculation_number"
                    ),
                    $request->getQueryParam(
                        "access_limited_object_ids"
                    ) === "true",
                    $request->getQueryParam(
                        "multi_fields"
                    ) === "true",
                    $request->getQueryParam(
                        "preferences"
                    ) === "true",
                    $request->getQueryParam(
                        "user_defined_fields"
                    ) === "true"
                )
            )
        );
    }
}
