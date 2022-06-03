<?php

namespace FluxIliasRestApi\Adapter\Route\CourseMember\RemoveCourseMember;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class RemoveCourseMemberByImportIdByUserIdRoute implements Route
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


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Remove course member by course import id and user id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Course import id"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "User id"
                )
            ],
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::JSON(),
                    null,
                    CourseMemberIdDto::class,
                    "Course member ids"
                ),
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::TEXT(),
                    LegacyDefaultStatus::_404(),
                    null,
                    "Course member not found"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::DELETE();
    }


    public function getRoute() : string
    {
        return "/course/by-import-id/{import_id}/remove-member/by-id/{user_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $id = $this->ilias_api->removeCourseMemberByImportIdByUserId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "user_id"
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
                    "Course member not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
