<?php

namespace FluxIliasRestApi\Adapter\Route\Course\GetCourse;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetCourseByIdRoute implements Route
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
        return "/course/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $course = $this->api->getCourseById(
            $request->getParam(
                "id"
            ),
            false
        );

        if ($course !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $course
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Course not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
