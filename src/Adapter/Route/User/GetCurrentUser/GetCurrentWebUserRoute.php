<?php

namespace FluxIliasRestApi\Adapter\Route\User\GetCurrentUser;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class GetCurrentWebUserRoute implements Route
{

    private Api $api;


    public static function new(Api $api) : /*static*/ self
    {
        $route = new static();

        $route->api = $api;

        return $route;
    }


    public function getDocuRequestBodyTypes() : ?array
    {
        return null;
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/user/current/web";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $user = $this->api->getCurrentWebUser(
            $request->getCookie(
                session_name()
            )
        );

        if ($user !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $user
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Invalid authorization"
                ),
                Status::_403
            );
        }
    }
}
