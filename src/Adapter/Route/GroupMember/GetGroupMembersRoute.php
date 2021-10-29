<?php

namespace FluxIliasRestApi\Adapter\Route\GroupMember;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;

class GetGroupMembersRoute implements Route
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
            "administrator_role",
            "group_id",
            "group_import_id",
            "group_ref_id",
            "learning_progress",
            "member_role",
            "notification",
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
        return "/group-members";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        return ResponseDto::new(
            JsonBodyDto::new(
                $this->api->getGroupMembers(
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
                    $request->getQueryParam(
                        "learning_progress"
                    ),
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
