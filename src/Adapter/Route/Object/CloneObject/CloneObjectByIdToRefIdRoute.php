<?php

namespace FluxIliasRestApi\Adapter\Route\Object\CloneObject;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class CloneObjectByIdToRefIdRoute implements Route
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
            "link",
            "prefer_link"
        ];
    }


    public function getMethod() : string
    {
        return Method::POST;
    }


    public function getRoute() : string
    {
        return "/object/by-id/{id}/clone/to-ref-id/{parent_ref_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->cloneObjectByIdToRefId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "parent_ref_id"
            ),
            $request->getQueryParam(
                "link"
            ) === "true",
            $request->getQueryParam(
                "prefer_link"
            ) === "true"
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
                Status::_404
            );
        }
    }
}
