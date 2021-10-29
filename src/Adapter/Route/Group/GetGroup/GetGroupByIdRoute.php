<?php

namespace FluxIliasRestApi\Adapter\Route\Group\GetGroup;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class GetGroupByIdRoute implements Route
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


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/group/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $group = $this->api->getGroupById(
            $request->getParam(
                "id"
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
                Status::_404
            );
        }
    }
}
