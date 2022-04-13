<?php

namespace FluxIliasRestApi\Adapter\Route\GroupMember;

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;
use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\LegacyDefaultMethod;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Libs\FluxRestApi\Adapter\Server\ServerResponseDto;

class GetGroupMembersRoute implements Route
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


    public function getMethod() : Method
    {
        return LegacyDefaultMethod::GET();
    }


    public function getRoute() : string
    {
        return "/group-members";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->ilias_api->getGroupMembers(
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
                    )) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null,
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
