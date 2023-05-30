<?php

namespace FluxIliasRestApi\Adapter\Route\User\UpdateUser;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;
use FluxIliasRestApi\Adapter\User\UserDiffDto;
use FluxIliasRestApi\Adapter\User\UserIdDto;

class UpdateUserByIdRoute implements Route
{

    private function __construct(
        private readonly IliasRestApi $ilias_rest_api
    ) {

    }


    public static function new(
        IliasRestApi $ilias_rest_api
    ) : static {
        return new static(
            $ilias_rest_api
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Update user by id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "User id"
                )
            ],
            null,
            [
                RouteContentTypeDocumentationDto::new(
                    DefaultBodyType::JSON,
                    UserDiffDto::class,
                    "User difference"
                )
            ],
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    UserIdDto::class,
                    "User ids"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "User not found"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_400,
                    null,
                    "No json body"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::PATCH;
    }


    public function getRoute() : string
    {
        return "/user/by-id/{id}/update";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                DefaultStatus::_400
            );
        }

        $id = $this->ilias_rest_api->updateUserById(
            $request->getParam(
                "id"
            ),
            UserDiffDto::newFromObject(
                $request->parsed_body->data
            )
        );

        if ($id !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "User not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
