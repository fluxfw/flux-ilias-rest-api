<?php

namespace FluxIliasRestApi\Adapter\Route\ScormLearningModule\GetScormLearningModule;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class GetScormLearningModuleByRefIdRoute implements Route
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
        return "/scorm-learning-module/by-ref-id/{ref_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $scorm_learning_module = $this->api->getScormLearningModuleByRefId(
            $request->getParam(
                "ref_id"
            )
        );

        if ($scorm_learning_module !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $scorm_learning_module
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Scorm learning module not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
