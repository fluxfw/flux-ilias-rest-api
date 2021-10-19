<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\Role\GetRole;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class GetRoleByImportIdRoute implements Route
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
        return "/role/by-import-id/{import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $role = $this->api->getRoleByImportId(
            $request->getParam(
                "import_id"
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
