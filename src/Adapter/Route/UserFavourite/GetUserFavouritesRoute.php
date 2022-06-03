<?php

namespace FluxIliasRestApi\Adapter\Route\UserFavourite;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\ObjectMember\ObjectMemberDto;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\UserFavourite\UserFavouriteDto;
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

class GetUserFavouritesRoute implements Route
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
                    LegacyDefaultBodyType::JSON(),
                    null,
                    UserFavouriteDto::class . "[]",
                    "User favourites"
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
        return "/user-favourites";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_api->getUserFavourites(
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
