<?php

namespace FluxIliasRestApi\Adapter\Route\Change;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Status\LegacyDefaultStatus;

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


    public function handle(RequestDto $request) : ?ResponseDto
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
            return ResponseDto::new(
                JsonBodyDto::new(
                    $changes
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Changes not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
