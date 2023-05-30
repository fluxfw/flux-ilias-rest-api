<?php

namespace FluxIliasRestApi\Adapter\Route\UserRole\RemoveUserRole;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;
use FluxIliasRestApi\Adapter\UserRole\UserRoleDto;

class RemoveUserRoleByImportIdByRoleImportIdRoute implements Route
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
            "Remove user role by user import id and role import id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "User import id"
                ),
                RouteParamDocumentationDto::new(
                    "role_import_id",
                    "string",
                    "Role import id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    UserRoleDto::class,
                    "User role"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "User role not found"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::DELETE;
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/remove-role/by-import-id/{role_import_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_rest_api->removeUserRoleByImportIdByRoleImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "role_import_id"
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
                    "User role not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
