<?php

namespace FluxIliasRestApi\Adapter\Route\Change;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetChangesRoute implements Route
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
            "after",
            "before",
            "from",
            "to"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/changes";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $changes = $this->api->getChanges(
            $request->getQueryParam(
                "from"
            ),
            $request->getQueryParam(
                "to"
            ),
            $request->getQueryParam(
                "after"
            ),
            $request->getQueryParam(
                "before"
            )
        );

        if ($changes !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $changes
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Changes not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
