<?php

namespace FluxIliasRestApi\Adapter\Route\UserRole\AddUserRole;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class AddUserRoleByImportIdByRoleIdRoute implements Route
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
        return Method::POST;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/add-role/by-id/{role_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->addUserRoleByImportIdByRoleId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "role_id"
            )
        );

        if ($id !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "User role not found"
                ),
                Status::_404
            );
        }
    }
}
