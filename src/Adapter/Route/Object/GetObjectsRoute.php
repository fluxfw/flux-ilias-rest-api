<?php

namespace FluxIliasRestApi\Adapter\Route\Object;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\Object\CustomObjectType;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;

class GetObjectsRoute implements Route
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
        return "/objects/{type}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getObjects(
                    CustomObjectType::factory($request->getParam(
                        "type"
                    )),
                    $request->getQueryParam(
                        "ref_ids"
                    ) === "true"
                )
            )
        );
    }
}
