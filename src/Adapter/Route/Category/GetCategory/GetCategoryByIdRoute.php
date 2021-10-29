<?php

namespace FluxIliasRestApi\Adapter\Route\Category\GetCategory;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class GetCategoryByIdRoute implements Route
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
        return "/category/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $category = $this->api->getCategoryById(
            $request->getParam(
                "id"
            )
        );

        if ($category !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $category
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Category not found"
                ),
                Status::_404
            );
        }
    }
}
