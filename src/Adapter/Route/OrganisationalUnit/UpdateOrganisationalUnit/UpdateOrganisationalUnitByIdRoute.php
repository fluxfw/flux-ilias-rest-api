<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnit\UpdateOrganisationalUnit;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class UpdateOrganisationalUnitByIdRoute implements Route
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
            "Update organisational unit by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Organisational unit id"
                )
            ],
            null,
            [
                RouteContentTypeDocumentationDto::new(
                    DefaultBodyType::JSON,
                    OrganisationalUnitDiffDto::class,
                    "Organisational unit difference"
                )
            ],
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    OrganisationalUnitIdDto::class,
                    "Organisational unit ids"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Organisational unit not found"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_400,
                    null,
                    "No json body"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::PATCH;
    }


    public function getRoute() : string
    {
        return "/organisational-unit/by-id/{id}/update";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                DefaultStatus::_400
            );
        }

        $id = $this->ilias_rest_api->updateOrganisationalUnitById(
            $request->getParam(
                "id"
            ),
            OrganisationalUnitDiffDto::newFromObject(
                $request->parsed_body->data
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
                    "Organisational unit not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
