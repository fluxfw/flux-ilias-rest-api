<?php

namespace FluxIliasRestApi\Adapter\Route\Role\GetRole;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class GetRoleByIdRoute implements Route
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
        return "/role/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $role = $this->api->getRoleById(
            $request->getParam(
                "id"
            )
        );

        if ($role !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $role
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Role not found"
                ),
                Status::_404
            );
        }
    }
}
