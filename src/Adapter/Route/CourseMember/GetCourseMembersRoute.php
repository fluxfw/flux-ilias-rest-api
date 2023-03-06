<?php

namespace FluxIliasRestApi\Adapter\Route\CourseMember;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
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

class GetCourseMembersRoute implements Route
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
            "Get course members",
            null,
            null,
            [
                RouteParamDocumentationDto::new(
                    "access_refused",
                    "bool",
                    "Only members have access refused"
                ),
                RouteParamDocumentationDto::new(
                    "administrator_role",
                    "bool",
                    "Only members have administrator role"
                ),
                RouteParamDocumentationDto::new(
                    "course_id",
                    "int",
                    "Only members in course by id"
                ),
                RouteParamDocumentationDto::new(
                    "course_import_id",
                    "string",
                    "Only members in course by import id"
                ),
                RouteParamDocumentationDto::new(
                    "course_ref_id",
                    "int",
                    "Only members in course by ref id"
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
                    "passed",
                    "bool",
                    "Only members have passed"
                ),
                RouteParamDocumentationDto::new(
                    "tutor_role",
                    "bool",
                    "Only members have tutor role"
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
                    CourseMemberDto::class . "[]",
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
        return "/course-members";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_rest_api->getCourseMembers(
                    $request->getQueryParam(
                        "course_id"
                    ),
                    $request->getQueryParam(
                        "course_import_id"
                    ),
                    $request->getQueryParam(
                        "course_ref_id"
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
                    ($tutor_role = $request->getQueryParam(
                        "tutor_role"
                    )) === "true" ? true : ($tutor_role === "false" ? false : null),
                    ($administrator_role = $request->getQueryParam(
                        "administrator_role"
                    )) === "true" ? true : ($administrator_role === "false" ? false : null),
                    ($learning_progress = $request->getQueryParam(
                        "learning_progress"
                    )) !== null ? ObjectLearningProgress::from($learning_progress) : null,
                    ($passed = $request->getQueryParam(
                        "passed"
                    )) === "true" ? true : ($passed === "false" ? false : null),
                    ($access_refused = $request->getQueryParam(
                        "access_refused"
                    )) === "true" ? true : ($access_refused === "false" ? false : null),
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
