<?php

namespace FluxIliasRestApi\Adapter\Route\User\GetCurrentUser;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Status\LegacyDefaultStatus;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetCurrentApiUserRoute implements Route
{

    private IliasApi $ilias_api;


    private function __construct(
        /*private readonly*/ IliasApi $ilias_api
    ) {
        $this->ilias_api = $ilias_api;
    }


    public static function new(
        IliasApi $ilias_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_api
        );
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
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/user/current/api";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $user = $this->ilias_api->getCurrentApiUser();

        if ($user !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $user
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Invalid authorization"
                ),
                LegacyDefaultStatus::_403()
            );
        }
    }
}
