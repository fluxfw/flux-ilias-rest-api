<?php

namespace FluxIliasRestApi\Adapter\Route\ScormLearningModule\UploadScormLearningModule;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\BodyType;
use FluxRestApi\Body\FormDataBodyDto;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class UploadScormLearningModuleByImportIdRoute implements Route
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
            BodyType::FORM_DATA
        ];
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : string
    {
        return Method::PUT;
    }


    public function getRoute() : string
    {
        return "/scorm-learning-module/by-import-id/{import_id}/upload";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof FormDataBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No form data body"
                ),
                Status::_400
            );
        }

        $id = $this->api->uploadScormLearningModuleByImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getParsedBody()->getFiles()["file"]["tmp_name"]
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
                    "Scorm learning module not found"
                ),
                Status::_404
            );
        }
    }
}
