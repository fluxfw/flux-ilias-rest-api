<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnit\GetOrganisationalUnit;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class GetOrganisationalUnitByIdRoute implements Route
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
        return "/organisational-unit/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $organisational_unit = $this->api->getOrganisationalUnitById(
            $request->getParam(
                "id"
            )
        );

        if ($organisational_unit !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $organisational_unit
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Organisational unit not found"
                ),
                Status::_404
            );
        }
    }
}
