<?php

namespace FluxIliasRestApi\Adapter\Route\File\UploadFile;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\FormDataBodyDto;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class UploadFileByRefIdRoute implements Route
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
            "Upload file by ref id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "ref_id",
                    "int",
                    "File ref id"
                )
            ],
            null,
            [
                RouteContentTypeDocumentationDto::new(
                    DefaultBodyType::FORM_DATA_2,
                    "object",
                    "File"
                )
            ],
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectIdDto::class,
                    "Object ids"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "File not found"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_400,
                    null,
                    "No form data body"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::PUT;
    }


    public function getRoute() : string
    {
        return "/file/by-ref-id/{ref_id}/upload";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof FormDataBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No form data body"
                ),
                DefaultStatus::_400
            );
        }

        $id = $this->ilias_rest_api->uploadFileByRefId(
            $request->getParam(
                "ref_id"
            ),
            $request->parsed_body->data["title"] ?? null,
            $request->parsed_body->data["replace"] === "true"
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
                    "File not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
