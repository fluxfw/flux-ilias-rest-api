<?php

namespace FluxIliasRestApi\Adapter\Route\ObjectLearningProgress;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;

class GetObjectLearningProgressRoute implements Route
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
        return [
            "learning_progress",
            "object_id",
            "object_import_id",
            "object_ref_id",
            "user_id",
            "user_import_id"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/object/learning-progress";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getObjectLearningProgress(
                    $request->getQueryParam(
                        "object_id"
                    ),
                    $request->getQueryParam(
                        "object_import_id"
                    ),
                    $request->getQueryParam(
                        "object_ref_id"
                    ),
                    $request->getQueryParam(
                        "user_id"
                    ),
                    $request->getQueryParam(
                        "user_import_id"
                    ),
                    ($learning_progress = $request->getQueryParam(
                        "learning_progress"
                    )) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null
                )
            )
        );
    }
}
