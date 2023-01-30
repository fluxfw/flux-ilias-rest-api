<?php

namespace FluxIliasRestApi\Adapter\Route\User\GetCurrentUser;

use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\TextBodyDto;
use FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxRestApi\Adapter\Status\DefaultStatus;

class GetCurrentWebUserRoute implements Route
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
            "Get current user logged in web",
            null,
            null,
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    UserDto::class,
                    "User"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_403,
                    null,
                    "Invalid authorization"
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
        return "/user/current/web";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $user = $this->ilias_rest_api->getCurrentWebUser(
            $request->getCookie(
                session_name()
            )
        );

        if ($user !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $user
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Invalid authorization"
                ),
                DefaultStatus::_403
            );
        }
    }
}
