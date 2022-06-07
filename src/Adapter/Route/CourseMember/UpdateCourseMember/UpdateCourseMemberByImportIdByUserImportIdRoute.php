<?php

namespace FluxIliasRestApi\Adapter\Route\CourseMember\UpdateCourseMember;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\Type\LegacyDefaultBodyType;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteContentTypeDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Status\LegacyDefaultStatus;

class UpdateCourseMemberByImportIdByUserImportIdRoute implements Route
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
            "Update course member by course import id and user import id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Course import id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "User import id"
                )
            ],
            null,
            [
                RouteContentTypeDocumentationDto::new(
                    LegacyDefaultBodyType::JSON(),
                    CourseMemberDto::class,
                    "Course member"
                )
            ],
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
                ),
                RouteResponseDocumentationDto::new(
                    LegacyDefaultBodyType::TEXT(),
                    LegacyDefaultStatus::_400(),
                    null,
                    "No json body"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::PATCH();
    }


    public function getRoute() : string
    {
        return "/course/by-import-id/{import_id}/update-member/by-import-id/{user_import_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                LegacyDefaultStatus::_400()
            );
        }

        $id = $this->ilias_api->updateCourseMemberByImportIdByUserImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getParam(
                "user_import_id"
            ),
            CourseMemberDiffDto::newFromObject(
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
                    "Course member not found"
                ),
                LegacyDefaultStatus::_404()
            );
        }
    }
}
