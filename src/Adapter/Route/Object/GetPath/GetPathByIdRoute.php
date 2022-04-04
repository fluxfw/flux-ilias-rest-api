<?php

namespace FluxIliasRestApi\Adapter\Route\Object\GetPath;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Status\LegacyDefaultStatus;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetPathByIdRoute implements Route
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
            "ref_ids"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/object/path/by-id/{id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $path = $this->ilias_api->getPathById(
            $request->getParam(
                "id"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true",
            false
        );

        if ($path !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $path
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
