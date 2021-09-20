<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Route\CourseMember\RemoveCourseMember;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Api;
use Fluxlabs\FluxRestApi\Body\JsonBodyDto;
use Fluxlabs\FluxRestApi\Body\TextBodyDto;
use Fluxlabs\FluxRestApi\Method\Method;
use Fluxlabs\FluxRestApi\Request\RequestDto;
use Fluxlabs\FluxRestApi\Response\ResponseDto;
use Fluxlabs\FluxRestApi\Route\Route;
use Fluxlabs\FluxRestApi\Status\Status;

class RemoveCourseMemberByIdByUserImportIdRoute implements Route
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
        return Method::DELETE;
    }


    public function getRoute() : string
    {
        return "/course/by-id/{id}/member/by-import-id/{user_import_id}/remove";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->removeCourseMemberByIdByUserImportId(
            $request->getParam(
                "id"
            ),
            $request->getParam(
                "user_import_id"
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
                    "Member not found"
                ),
                Status::_404
            );
        }
    }
}
