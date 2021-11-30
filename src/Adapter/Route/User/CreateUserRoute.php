<?php

namespace FluxIliasRestApi\Adapter\Route\User;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestBaseApi\Body\LegacyDefaultBodyType;
use FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxRestBaseApi\Method\Method;
use FluxRestBaseApi\Status\LegacyDefaultStatus;

class CreateUserRoute implements Route
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
        return [
            LegacyDefaultBodyType::JSON()
        ];
    }


    public function getDocuRequestQueryParams() : ?array
    {
        return null;
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::POST();
    }


    public function getRoute() : string
    {
        return "/user/create";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        if (!($request->getParsedBody() instanceof JsonBodyDto)) {
            return ResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                LegacyDefaultStatus::_400()
            );
        }

        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->createUser(
                    UserDiffDto::newFromData(
                        $request->getParsedBody()->getData()
                    )
                )
            )
        );
    }
}
