<?php

namespace FluxIliasRestApi\Adapter\Route\ObjectLearningProgress\UpdateObjectLearningProgress;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Body\LegacyDefaultBodyType;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class UpdateObjectLearningProgressByImportIdByUserIdRoute implements Route
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
            LegacyDefaultBodyType::JSON()
        ];
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::PATCH();
    }


    public function getRoute() : string
    {
        return "/object/by-import-id/{import_id}/update-learning-progress/by-id/{user_id}/{learning_progress}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->updateObjectLearningProgressByImportIdByUserId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "user_id"
            ),
            LegacyObjectLearningProgress::from($request->getParam(
                "learning_progress"
            ))
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
                    "Learning progress not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
