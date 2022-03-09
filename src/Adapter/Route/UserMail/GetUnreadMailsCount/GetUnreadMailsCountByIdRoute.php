<?php

namespace FluxIliasRestApi\Adapter\Route\UserMail\GetUnreadMailsCount;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Status\LegacyDefaultStatus;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetUnreadMailsCountByIdRoute implements Route
{

    private IliasRestApi $ilias_rest_api;


    private function __construct(
        /*private readonly*/ IliasRestApi $ilias_rest_api
    ) {
        $this->ilias_rest_api = $ilias_rest_api;
    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_rest_api
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


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $count = $this->ilias_rest_api->getUnreadMailsCountById(
            $request->getParam(
                "id"
            )
        );

        if ($count !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $count
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "User not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
