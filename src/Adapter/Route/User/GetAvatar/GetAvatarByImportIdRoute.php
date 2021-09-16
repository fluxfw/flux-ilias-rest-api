<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\User\GetAvatar;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxIliasRestApi\Adapter\Route\SendfileIliasDataDir;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class GetAvatarByImportIdRoute implements Route
{

    use SendfileIliasDataDir;

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
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/avatar";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $avatar = $this->api->getAvatarPathByImportId(
            $request->getParam(
                "import_id"
            )
        );

        if ($avatar !== null) {
            return ResponseDto::new(
                null,
                null,
                null,
                null,
                $this->sendfileIliasDataDir(
                    $request,
                    $avatar
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Avatar not found"
                ),
                Status::_404
            );
        }
    }
}
