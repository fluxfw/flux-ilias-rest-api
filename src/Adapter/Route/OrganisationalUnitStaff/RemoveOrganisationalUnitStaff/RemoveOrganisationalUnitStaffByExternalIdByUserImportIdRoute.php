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

class RemoveOrganisationalUnitStaffByExternalIdByUserImportIdRoute implements Route
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
            "Remove organisational unit staff by organisational unit external id and user import id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "external_id",
                    "string",
                    "Organisational unit external id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "User import id"
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
        return "/organisational-unit/by-external-id/{external_id}/remove-staff/by-import-id/{user_import_id}/{position_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_rest_api->removeOrganisationalUnitStaffByExternalIdByUserImportId(
            $request->getParam(
                "external_id"
            ),
            $request->getParam(
                "user_import_id"
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
