<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\UserFavourite\RemoveUserFavourite;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class RemoveUserFavouriteByImportIdByObjectIdRoute implements Route
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
        return Method::DELETE;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/remove-favourite/by-id/{object_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->removeUserFavouriteByImportIdByObjectId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "object_id"
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
