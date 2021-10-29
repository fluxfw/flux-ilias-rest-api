<?php

namespace FluxIliasRestApi\Adapter\Route\UserFavourite\AddUserFavourite;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class AddUserFavouriteByImportIdByObjectRefIdRoute implements Route
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


    public function getMethod() : string
    {
        return Method::POST;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/add-favourite/by-ref-id/{object_ref_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->addUserFavouriteByImportIdByObjectRefId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "object_ref_id"
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
                Status::_404
            );
        }
    }
}
