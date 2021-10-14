<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\ObjectLearningProgress\UpdateObjectLearningProgress;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\BodyType;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class UpdateObjectLearningProgressByIdByUserImportIdRoute implements Route
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
        return "/object/by-id/{id}/update-learning-progress/by-import-id/{user_import_id}/{learning_progress}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->updateObjectLearningProgressByIdByUserImportId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "user_import_id"
            ),
            $request->getParam(
                "learning_progress"
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
                    "Learning progress not found"
                ),
                Status::_404
            );
        }
    }
}
