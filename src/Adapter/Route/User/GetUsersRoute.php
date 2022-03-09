<?php

namespace FluxIliasRestApi\Adapter\Route\User;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetUsersRoute implements Route
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
        return [
            "access_limited_object_ids",
            "multi_fields",
            "preferences",
            "user_defined_fields"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/users";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getUsers(
                    $request->getQueryParam(
                        "access_limited_object_ids"
                    ) === "true",
                    $request->getQueryParam(
                        "multi_fields"
                    ) === "true",
                    $request->getQueryParam(
                        "preferences"
                    ) === "true",
                    $request->getQueryParam(
                        "user_defined_fields"
                    ) === "true"
                )
            )
        );
    }
}
