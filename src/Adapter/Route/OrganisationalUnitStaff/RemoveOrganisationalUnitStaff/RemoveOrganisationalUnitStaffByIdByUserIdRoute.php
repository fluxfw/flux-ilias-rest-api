<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitStaff\RemoveOrganisationalUnitStaff;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\OrganisationalUnitStaff\OrganisationalUnitStaffDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class RemoveOrganisationalUnitStaffByIdByUserIdRoute implements Route
{

    private function __construct(
        private readonly IliasRestApi $ilias_rest_api
    ) {

    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : static {
        return new static(
            $ilias_rest_api
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Remove organisational unit staff by organisational unit id and user id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Organisational unit id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "User id"
                ),
                RouteParamDocumentationDto::new(
                    "position_id",
                    "int",
                    "Organisational unit position id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    OrganisationalUnitStaffDto::class,
                    "Organisational unit staff"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Organisational unit staff not found"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::DELETE;
    }


    public function getRoute() : string
    {
        return "/organisational-unit/by-id/{id}/remove-staff/by-id/{user_id}/{position_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_rest_api->removeOrganisationalUnitStaffByIdByUserId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "user_id"
            ),
            $request->getParam(
                "position_id"
            )
        );

        if ($id !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Organisational unit staff not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
