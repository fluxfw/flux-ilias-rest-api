<?php

namespace FluxIliasRestApi\Adapter\Route\File;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;

class GetFilesRoute implements Route
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
        return "/files";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getFiles()
            )
        );
    }
}
