<?php

namespace FluxIliasRestApi\Adapter\Route\Object\CreateObject;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\Object\CustomObjectType;
use FluxIliasRestApi\Adapter\Api\Object\ObjectDiffDto;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Body\LegacyDefaultBodyType;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class CreateObjectToImportIdRoute implements Route
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
        return LegacyDefaultMethod::POST();
    }


    public function getRoute() : string
    {
        return "/object/create/{type}/to-import-id/{parent_import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                LegacyDefaultStatus::_400()
            );
        }

        $id = $this->api->createObjectToImportId(
            CustomObjectType::factory($request->getParam(
                "type"
            )),
            $request->getParam(
                "parent_import_id"
            ),
            ObjectDiffDto::newFromData(
                $request->getParsedBody()->getData()
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
                    "Object not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
