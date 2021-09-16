<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\Course\GetCourse;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class GetCourseByRefIdRoute implements Route
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
        return "/course/by-ref-id/{ref_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $course = $this->api->getCourseByRefId(
            $request->getParam(
                "ref_id"
            )
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
                Status::_404
            );
        }
    }
}
