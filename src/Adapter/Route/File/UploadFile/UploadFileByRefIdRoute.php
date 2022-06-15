<?php

namespace FluxIliasRestApi\Adapter\Route\File\UploadFile;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\FormDataBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class UploadFileByRefIdRoute implements Route
{

    private IliasApi $ilias_api;


    private function __construct(
        /*private readonly*/ IliasApi $ilias_api
    ) {
        $this->ilias_api = $ilias_api;
    }


    public static function new(
        IliasApi $ilias_api
    ) : static {
        return new static(
            $ilias_api
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
                    LegacyDefaultBodyType::FORM_DATA_2(),
                    "object",
                    "File"
                )
            ],
            [
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::JSON(),
                    null,
                    ObjectIdDto::class,
                    "Object ids"
                ),
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::TEXT(),
                    LegacyDefaultStatus::_404(),
                    null,
                    "File not found"
                ),
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::TEXT(),
                    LegacyDefaultStatus::_400(),
                    null,
                    "No form data body"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::PUT();
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
                LegacyDefaultStatus::_400()
            );
        }

        $id = $this->ilias_api->uploadFileByRefId(
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
                LegacyDefaultStatus::_404()
            );
        }
    }
}
