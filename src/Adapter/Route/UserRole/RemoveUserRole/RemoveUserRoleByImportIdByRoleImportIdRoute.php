<?php

namespace FluxIliasRestApi\Adapter\Route\UserRole\RemoveUserRole;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Status\LegacyDefaultStatus;

class RemoveUserRoleByImportIdByRoleImportIdRoute implements Route
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
        return LegacyDefaultMethod::DELETE();
    }


    public function getRoute() : string
    {
        return "/user/by-import-id/{import_id}/remove-role/by-import-id/{role_import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->ilias_api->removeUserRoleByImportIdByRoleImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "role_import_id"
            )
        );

        if ($id !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $id
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "User role not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
