<?php

namespace FluxIliasRestApi\Adapter\Route\UserFavourite;

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
use FluxIliasRestApi\Adapter\UserFavourite\UserFavouriteDto;

class GetUserFavouritesRoute implements Route
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
            "Get object favourites",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "object_id",
                    "int",
                    "Only users has object by id"
                ),
                RouteParamDocumentationDto::new(
                    "object_import_id",
                    "string",
                    "Only users has object by import id"
                ),
                RouteParamDocumentationDto::new(
                    "object_ref_id",
                    "int",
                    "Only users has object by ref id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "Only objects has user by id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "Only objects has user by import id"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    UserFavouriteDto::class . "[]",
                    "User favourites"
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
        return "/user-favourites";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getUserFavourites(
                    $request->getQueryParam(
                        "user_id"
                    ),
                    $request->getQueryParam(
                        "user_import_id"
                    ),
                    $request->getQueryParam(
                        "object_id"
                    ),
                    $request->getQueryParam(
                        "object_import_id"
                    ),
                    $request->getQueryParam(
                        "object_ref_id"
                    )
                )
            )
        );
    }
}
