<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitStaff;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
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

class GetOrganisationalUnitStaffRoute implements Route
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
            "Get organisational unit staff",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "organisational_unit_external_id",
                    "string",
                    "Only users in organisational unit by external id"
                ),
                RouteParamDocumentationDto::new(
                    "organisational_unit_id",
                    "int",
                    "Only users in organisational unit by id"
                ),
                RouteParamDocumentationDto::new(
                    "organisational_unit_ref_id",
                    "int",
                    "Only users in organisational unit by ref id"
                ),
                RouteParamDocumentationDto::new(
                    "position_id",
                    "int",
                    "Only users in has position in organisational unit"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "Only organisational units has user by id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "Only organisational units has user by import id"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    OrganisationalUnitStaffDto::class . "[]",
                    "Organisational unit staff"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/organisational-unit-staff";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getOrganisationalUnitStaff(
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
