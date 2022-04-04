<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition\GetOrganisationalUnitPosition;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Status\LegacyDefaultStatus;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetOrganisationalUnitPositionByCoreIdentifierRoute implements Route
{

    private IliasApi $ilias_api;


    private function __construct(
        /*private readonly*/ IliasApi $ilias_api
    ) {
        $this->ilias_api = $ilias_api;
    }


    public static function new(
        IliasApi $ilias_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_api
        );
    }


    public function getDocuRequestBodyTypes() : ?array
    {
        return null;
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/organisational-unit-position/by-core-identifier/{core_identifier}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $organisational_unit_position = $this->ilias_api->getOrganisationalUnitPositionByCoreIdentifier(
            LegacyOrganisationalUnitPositionCoreIdentifier::from($request->getParam(
                "core_identifier"
            ))
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
                LegacyDefaultStatus::_404()
            );
        }
    }
}
