<?php

namespace FluxIliasRestApi\Adapter\Route\GroupMember;

use FluxIliasBaseApi\Adapter\GroupMember\GroupMemberDto;
use FluxIliasBaseApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;

class GetGroupMembersRoute implements Route
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
            "Get group members",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "administrator_role",
                    "bool",
                    "Only members have administrator role"
                ),
                RouteParamDocumentationDto::new(
                    "group_id",
                    "int",
                    "Only members in group by id"
                ),
                RouteParamDocumentationDto::new(
                    "group_import_id",
                    "string",
                    "Only members in group by import id"
                ),
                RouteParamDocumentationDto::new(
                    "group_ref_id",
                    "int",
                    "Only members in group by ref id"
                ),
                RouteParamDocumentationDto::new(
                    "learning_progress",
                    ObjectLearningProgress::class,
                    "Only members have learning progress"
                ),
                RouteParamDocumentationDto::new(
                    "member_role",
                    "bool",
                    "Only members have member role"
                ),
                RouteParamDocumentationDto::new(
                    "notification",
                    "bool",
                    "Only members have notification"
                ),
                RouteParamDocumentationDto::new(
                    "tutorial_support",
                    "bool",
                    "Only members have tutorial support"
                ),
                RouteParamDocumentationDto::new(
                    "user_id",
                    "int",
                    "Only user by id"
                ),
                RouteParamDocumentationDto::new(
                    "user_import_id",
                    "string",
                    "Only user by import id"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    GroupMemberDto::class . "[]",
                    "Course members"
                )
            ]
        );
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/group-members";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getGroupMembers(
                    $request->getQueryParam(
                        "group_id"
                    ),
                    $request->getQueryParam(
                        "group_import_id"
                    ),
                    $request->getQueryParam(
                        "group_ref_id"
                    ),
                    $request->getQueryParam(
                        "user_id"
                    ),
                    $request->getQueryParam(
                        "user_import_id"
                    ),
                    ($member_role = $request->getQueryParam(
                        "member_role"
                    )) === "true" ? true : ($member_role === "false" ? false : null),
                    ($administrator_role = $request->getQueryParam(
                        "administrator_role"
                    )) === "true" ? true : ($administrator_role === "false" ? false : null),
                    ($learning_progress = $request->getQueryParam(
                        "learning_progress"
                    )) !== null ? ObjectLearningProgress::from($learning_progress) : null,
                    ($tutorial_support = $request->getQueryParam(
                        "tutorial_support"
                    )) === "true" ? true : ($tutorial_support === "false" ? false : null),
                    ($notification = $request->getQueryParam(
                        "notification"
                    )) === "true" ? true : ($notification === "false" ? false : null)
                )
            )
        );
    }
}
