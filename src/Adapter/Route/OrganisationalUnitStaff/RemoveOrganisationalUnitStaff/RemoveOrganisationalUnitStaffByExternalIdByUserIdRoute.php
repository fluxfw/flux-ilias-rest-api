<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\OrganisationalUnitStaff\RemoveOrganisationalUnitStaff;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class RemoveOrganisationalUnitStaffByExternalIdByUserIdRoute implements Route
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
        return Method::DELETE;
    }


    public function getRoute() : string
    {
        return "/organisational-unit/by-external-id/{external_id}/remove-staff/by-id/{user_id}/{position_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->removeOrganisationalUnitStaffByExternalIdByUserId(
            $request->getParam(
                "external_id"
            ),
            $request->getParam(
                "user_id"
            ),
            $request->getParam(
                "position_id"
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
                    "Organisational unit staff not found"
                ),
                Status::_404
            );
        }
    }
}
