<?php

namespace FluxIliasRestApi\Adapter\Route\Course\UpdateCourse;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Body\BodyType;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\Status;

class UpdateCourseByIdRoute implements Route
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
        return "/course/by-id/{id}/update";
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

        $id = $this->api->updateCourseById(
            $request->getParam(
                "id"
            ),
            CourseDiffDto::newFromData(
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
                    "Course not found"
                ),
                Status::_404
            );
        }
    }
}
