<?php

namespace FluxIliasRestApi\Adapter\Route\ScormLearningModule\GetScormLearningModule;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\ScormLearningModule\ScormLearningModuleDto;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetScormLearningModuleByIdRoute implements Route
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
            "Get scorm learning module by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Scorm learning module id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ScormLearningModuleDto::class,
                    "Scorm learning module"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Scorm learning module not found"
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
        return "/scorm-learning-module/by-id/{id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $scorm_learning_module = $this->ilias_rest_api->getScormLearningModuleById(
            $request->getParam(
                "id"
            ),
            false
        );

        if ($scorm_learning_module !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $scorm_learning_module
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Scorm learning module not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
