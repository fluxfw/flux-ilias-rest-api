<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\OrganisationalUnitStaff;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;

class GetOrganisationalUnitStaffRoute implements Route
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
        return [
            "organisational_unit_external_id",
            "organisational_unit_id",
            "organisational_unit_ref_id",
            "position_id",
            "user_id",
            "user_import_id"
        ];
    }


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/organisational-unit-staff";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getOrganisationalUnitStaff(
                    $request->getQueryParam(
                        "organisational_unit_id"
                    ),
                    $request->getQueryParam(
                        "organisational_unit_external_id"
                    ),
                    $request->getQueryParam(
                        "organisational_unit_ref_id"
                    ),
                    $request->getQueryParam(
                        "user_id"
                    ),
                    $request->getQueryParam(
                        "user_import_id"
                    ),
                    $request->getQueryParam(
                        "position_id"
                    )
                )
            )
        );
    }
}
