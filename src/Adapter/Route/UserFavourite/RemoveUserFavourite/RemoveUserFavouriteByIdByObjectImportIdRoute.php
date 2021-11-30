<?php

namespace FluxIliasRestApi\Adapter\Route\UserFavourite\RemoveUserFavourite;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class RemoveUserFavouriteByIdByObjectImportIdRoute implements Route
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
        return LegacyDefaultMethod::DELETE();
    }


    public function getRoute() : string
    {
        return "/user/by-id/{id}/remove-favourite/by-import-id/{object_import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->removeUserFavouriteByIdByObjectImportId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "object_import_id"
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
                    "User favourite not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
