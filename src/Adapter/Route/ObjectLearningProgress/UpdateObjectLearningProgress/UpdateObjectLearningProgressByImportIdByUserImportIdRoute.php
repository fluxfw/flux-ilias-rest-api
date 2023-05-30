<?php

namespace FluxIliasRestApi\Adapter\Route\ObjectLearningProgress\UpdateObjectLearningProgress;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgressIdDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class UpdateObjectLearningProgressByImportIdByUserImportIdRoute implements Route
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
            "Update learning progress by object import id and user import id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Object import id"
                ),
                RouteParamDocumentationDto::new(
                    "learning_progress",
                    ObjectLearningProgress::class,
                    "Object learning progress"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "User import id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectLearningProgressIdDto::class,
                    "Learning progress ids"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Learning progress not found"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::PATCH;
    }


    public function getRoute() : string
    {
        return "/object/by-import-id/{import_id}/update-learning-progress/by-import-id/{user_import_id}/{learning_progress}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_rest_api->updateObjectLearningProgressByImportIdByUserImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "user_import_id"
            ),
            ObjectLearningProgress::from($request->getParam(
                "learning_progress"
            ))
        );

        if ($id !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Learning progress not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
