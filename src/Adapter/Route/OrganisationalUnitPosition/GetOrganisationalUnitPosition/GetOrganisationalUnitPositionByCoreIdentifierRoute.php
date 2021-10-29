<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition\GetOrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class GetOrganisationalUnitPositionByCoreIdentifierRoute implements Route
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
        return "/organisational-unit-position/by-core-identifier/{core_identifier}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $organisational_unit_position = $this->api->getOrganisationalUnitPositionByCoreIdentifier(
            $request->getParam(
                "core_identifier"
            )
        );

        if ($organisational_unit_position !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $organisational_unit_position
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Organisational unit position not found"
                ),
                Status::_404
            );
        }
    }
}
