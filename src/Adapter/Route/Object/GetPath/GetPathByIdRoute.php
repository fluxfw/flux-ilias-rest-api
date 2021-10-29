<?php

namespace FluxIliasRestApi\Adapter\Route\Object\GetPath;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class GetPathByIdRoute implements Route
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


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/object/path/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $path = $this->api->getPathById(
            $request->getParam(
                "id"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true"
        );

        if ($path !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $path
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
