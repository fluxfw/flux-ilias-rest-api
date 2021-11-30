<?php

namespace FluxIliasRestApi\Adapter\Route\Object\LinkObject;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class LinkObjectByRefIdToIdRoute implements Route
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
        return LegacyDefaultMethod::POST();
    }


    public function getRoute() : string
    {
        return "/object/by-ref-id/{ref_id}/link/to-id/{parent_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->linkObjectByRefIdToId(
            $request->getParam(
                "ref_id"
            ),
            $request->getParam(
                "parent_id"
            )
        );

        if ($id !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $id
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
