<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\CourseMember\GetCourseMember;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class GetCourseMemberByRefIdByUserIdRoute implements Route
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
        return null;
    }


    public function getMethod() : string
    {
        return Method::GET;
    }


    public function getRoute() : string
    {
        return "/course/by-ref-id/{ref_id}/member/by-id/{user_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $course_member = $this->api->getCourseMemberByRefIdByUserId(
            $request->getParam(
                "ref_id"
            ),
            $request->getParam(
                "user_id"
            )
        );

        if ($course_member !== null) {
            return ResponseDto::new(
                JsonBodyDto::new(
                    $course_member
                )
            );
        } else {
            return ResponseDto::new(
                TextBodyDto::new(
                    "Member not found"
                ),
                Status::_404
            );
        }
    }
}
