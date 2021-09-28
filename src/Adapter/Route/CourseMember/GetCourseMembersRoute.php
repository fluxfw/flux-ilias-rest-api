<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\CourseMember;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;

class GetCourseMembersRoute implements Route
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


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/course-members";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getCourseMembers(
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
                    $request->getQueryParam(
                        "learning_progress"
                    ),
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
