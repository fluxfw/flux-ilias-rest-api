<?php

namespace FluxIliasRestApi\Adapter\Route\Category\GetCategory;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetCategoryByImportIdRoute implements Route
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
        return "/category/by-import-id/{import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $category = $this->api->getCategoryByImportId(
            $request->getParam(
                "import_id"
            ),
            false
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
                LegacyDefaultStatus::_404()
            );
        }
    }
}
