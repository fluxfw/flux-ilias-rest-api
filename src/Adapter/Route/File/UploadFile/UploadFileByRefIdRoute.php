<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\File\UploadFile;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\BodyType;
use Fluxlabs\FluxRestApi\Body\FormDataBodyDto;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class UploadFileByRefIdRoute implements Route
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
        return "/file/by-ref-id/{ref_id}/upload";
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

        $id = $this->api->uploadFileByRefId(
            $request->getParam(
                "ref_id"
            ),
            $request->getParsedBody()->getData()["title"] ?? null,
            $request->getParsedBody()->getData()["replace"] === "true"
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
                    "File not found"
                ),
                Status::_404
            );
        }
    }
}
