<?php

namespace FluxIliasRestApi\Adapter\Route\GroupMember\RemoveGroupMember;

use FluxIliasRestApi\Adapter\Api\Api;
use FluxRestApi\Body\JsonBodyDto;
use FluxRestApi\Body\TextBodyDto;
use FluxRestApi\Method\Method;
use FluxRestApi\Request\RequestDto;
use FluxRestApi\Response\ResponseDto;
use FluxRestApi\Route\Route;
use FluxRestApi\Status\Status;

class RemoveGroupMemberByRefIdByUserImportIdRoute implements Route
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
        return "/group/by-ref-id/{ref_id}/remove-member/by-import-id/{user_import_id}";
    }


    public function handle(RequestDto $request) : ?ResponseDto
    {
        $id = $this->api->removeGroupMemberByRefIdByUserImportId(
            $request->getParam(
                "ref_id"
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
                    "Group member not found"
                ),
                Status::_404
            );
        }
    }
}
