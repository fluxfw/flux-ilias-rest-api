<?php

namespace FluxIliasRestApi\Adapter\Route\Course\GetCourse;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Status\LegacyDefaultStatus;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetCourseByRefIdRoute implements Route
{

    private IliasRestApi $ilias_rest_api;


    private function __construct(
        /*private readonly*/ IliasRestApi $ilias_rest_api
    ) {
        $this->ilias_rest_api = $ilias_rest_api;
    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_rest_api
        );
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
        return "/course/by-ref-id/{ref_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $course = $this->ilias_rest_api->getCourseByRefId(
            $request->getParam(
                "ref_id"
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
