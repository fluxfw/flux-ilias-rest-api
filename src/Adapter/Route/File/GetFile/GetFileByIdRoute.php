<?php

namespace FluxIliasRestApi\Adapter\Route\File\GetFile;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class GetFileByIdRoute implements Route
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
        return "/file/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $file = $this->api->getFileById(
            $request->getParam(
                "id"
            )
        );

        if ($file !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $file
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "File not found"
                ),
                Status::_404
            );
        }
    }
}
