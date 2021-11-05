<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;

class GetOrganisationalUnitPositionsRoute implements Route
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
            "authorities"
        ];
    }


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/organisational-unit-positions";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getOrganisationalUnitPositions(
                    $request->getQueryParam(
                        "authorities"
                    ) === "true"
                )
            )
        );
    }
}
