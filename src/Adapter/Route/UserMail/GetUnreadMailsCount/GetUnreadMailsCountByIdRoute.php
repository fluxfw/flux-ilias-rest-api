<?php

namespace FluxIliasRestApi\Adapter\Route\UserMail\GetUnreadMailsCount;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class GetUnreadMailsCountByIdRoute implements Route
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
        return "/user/by-id/{id}/unread-mails-count";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $count = $this->ilias_api->getUnreadMailsCountById(
            $request->getParam(
                "id"
            )
        );

        if ($count !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $count
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "User not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
