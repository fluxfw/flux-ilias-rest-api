<?php

namespace FluxIliasRestApi\Adapter\Route\Object\GetChildren;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetChildrenByImportIdRoute implements Route
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
        return [
            "ref_ids"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/object/children/by-import-id/{import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $children = $this->api->getChildrenByImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true",
            false
        );

        if ($children !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $children
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Object not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
