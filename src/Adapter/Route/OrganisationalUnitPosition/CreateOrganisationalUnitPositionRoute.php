<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class CreateOrganisationalUnitPositionRoute implements Route
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
            "Create organisational unit position",
            null,
            null,
            null,
            [
                RouteContentTypeDocumentationDto::new(
                    DefaultBodyType::JSON,
                    OrganisationalUnitPositionDiffDto::class,
                    "Organisational unit position difference"
                )
            ],
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    OrganisationalUnitPositionIdDto::class,
                    "Organisational unit position ids"
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
        return DefaultMethod::POST;
    }


    public function getRoute() : string
    {
        return "/organisational-unit-position/create";
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

        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->createOrganisationalUnitPosition(
                    OrganisationalUnitPositionDiffDto::newFromObject(
                        $request->parsed_body->data
                    )
                )
            )
        );
    }
}
