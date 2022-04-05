<?php

namespace FluxIliasRestApi\Adapter\Route\OrganisationalUnitPosition\GetOrganisationalUnitPosition;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Status\LegacyDefaultStatus;

class GetOrganisationalUnitPositionByIdRoute implements Route
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
        return "/organisational-unit-position/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $organisational_unit_position = $this->ilias_api->getOrganisationalUnitPositionById(
            $request->getParam(
                "id"
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
                LegacyDefaultStatus::_404()
            );
        }
    }
}
