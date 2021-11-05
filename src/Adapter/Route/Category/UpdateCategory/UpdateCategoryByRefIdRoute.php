<?php

namespace FluxIliasRestApi\Adapter\Route\Category\UpdateCategory;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\Category\CategoryDiffDto;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Body\BodyType;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class UpdateCategoryByRefIdRoute implements Route
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
        return [
            BodyType::JSON
        ];
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : string
    {
        return Method::PATCH;
    }


    public function getRoute() : string
    {
        return "/category/by-ref-id/{ref_id}/update";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                Status::_400
            );
        }

        $id = $this->api->updateCategoryByRefId(
            $request->getParam(
                "ref_id"
            ),
            CategoryDiffDto::newFromData(
                $request->getParsedBody()->getData()
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
                    "Category not found"
                ),
                Status::_404
            );
        }
    }
}
