<?php

namespace FluxIliasRestApi\Adapter\Route\Change;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class GetChangesRoute implements Route
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
        return [
            "after",
            "before",
            "from",
            "to"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/changes";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $changes = $this->ilias_api->getChanges(
            $request->getQueryParam(
                "from"
            ),
            $request->getQueryParam(
                "to"
            ),
            $request->getQueryParam(
                "after"
            ),
            $request->getQueryParam(
                "before"
            )
        );

        if ($changes !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $changes
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Changes not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
