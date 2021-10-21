<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\Object\GetChildren;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class GetChildrenByIdRoute implements Route
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
        return "/object/children/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $children = $this->api->getChildrenById(
            $request->getParam(
                "id"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true"
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
                Status::_404
            );
        }
    }
}
