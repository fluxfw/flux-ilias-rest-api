<?php

namespace FluxIliasRestApi\Adapter\Route\Category\GetCategory;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Category\CategoryDto;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\TextBodyDto;
use FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxRestApi\Adapter\Status\DefaultStatus;

class GetCategoryByIdRoute implements Route
{

    private function __construct(
        private readonly IliasRestApi $ilias_rest_api
    ) {

    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : static {
        return new static(
            $ilias_rest_api
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Get category by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Category id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    CategoryDto::class,
                    "Category"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Category not found"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/category/by-id/{id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $category = $this->ilias_rest_api->getCategoryById(
            $request->getParam(
                "id"
            ),
            false
        );

        if ($category !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $category
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Category not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
