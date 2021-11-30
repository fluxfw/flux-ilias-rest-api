<?php

namespace FluxIliasRestApi\Adapter\Route\Group\GetGroup;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetGroupByImportIdRoute implements Route
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


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/group/by-import-id/{import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $group = $this->api->getGroupByImportId(
            $request->getParam(
                "import_id"
            )
        );

        if ($group !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $group
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Group not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
