<?php

namespace FluxIliasRestApi\Adapter\Route\CourseMember;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxIliasRestApi\Libs\FluxRestApi\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Libs\FluxRestBaseApi\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Request\RequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Response\ResponseDto;
use FluxIliasRestApi\Libs\FluxRestApi\Route\Route;

class GetCourseMembersRoute implements Route
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
            "access_refused",
            "administrator_role",
            "course_id",
            "course_import_id",
            "course_ref_id",
            "learning_progress",
            "member_role",
            "notification",
            "passed",
            "tutor_role",
            "tutorial_support",
            "user_id",
            "user_import_id"
        ];
    }


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/course-members";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_api->getCourseMembers(
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
                    )) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null,
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
