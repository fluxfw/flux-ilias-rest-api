<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use Fluxlabs\FluxRestApi\Body\BodyType;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class CreateOrganisationalUnitPositionRoute implements Route
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
        return [
            BodyType::JSON
        ];
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
        return "/organisational-unit-position/create";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                Status::_400
            );
        }

        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->createOrganisationalUnitPosition(
                    OrganisationalUnitPositionDiffDto::newFromData(
                        $request->getParsedBody()->getData()
                    )
                )
            )
        );
    }
}
