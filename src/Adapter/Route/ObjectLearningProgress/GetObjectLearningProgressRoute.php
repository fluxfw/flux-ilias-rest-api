<?php

namespace FluxIliasRestApi\Adapter\Route\ObjectLearningProgress;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgressDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

class GetObjectLearningProgressRoute implements Route
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
            "Get learning progresses",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "learning_progress",
                    ObjectLearningProgress::class,
                    "Only users have learning progress"
                ),
                RouteParamDocumentationDto::new(
                    "object_id",
                    "int",
                    "Only users in object by id"
                ),
                RouteParamDocumentationDto::new(
                    "object_import_id",
                    "string",
                    "Only users in object by import id"
                ),
                RouteParamDocumentationDto::new(
                    "object_ref_id",
                    "int",
                    "Only users in object by ref id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "Only user by id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "Only user by import id"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectLearningProgressDto::class . "[]",
                    "Learning progresses"
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
        return "/object/learning-progress";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getObjectLearningProgress(
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
                    )) !== null ? ObjectLearningProgress::from($learning_progress) : null
                )
            )
        );
    }
}
