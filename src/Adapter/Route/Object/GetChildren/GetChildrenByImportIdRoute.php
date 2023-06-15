<?php

namespace FluxIliasRestApi\Adapter\Route\Object\GetChildren;

use FluxIliasRestApi\Adapter\Api\IliasRestApi;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Object\CustomObjectType;
use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Object\ObjectType;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteParamDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;

class GetChildrenByImportIdRoute implements Route
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
            "Get children of object by import id",
            null,
            [
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Object import id"
                )
            ],
            [
                RouteParamDocumentationDto::new(
                    "id",
                    "int",
                    "Filter object to id"
                ),
                RouteParamDocumentationDto::new(
                    "import_id",
                    "string",
                    "Filter object to import id"
                ),
                RouteParamDocumentationDto::new(
                    "ref_id",
                    "int",
                    "Filter object to ref id"
                ),
                RouteParamDocumentationDto::new(
                    "types",
                    ObjectType::class . "[]",
                    "Filter by object types split by ,"
                ),
                RouteParamDocumentationDto::new(
                    "created",
                    "float",
                    "Only objects created on timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "created_from",
                    "float",
                    "Only objects created from timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "created_to",
                    "float",
                    "Only objects created to timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "created_after",
                    "float",
                    "Only objects created after timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "created_before",
                    "float",
                    "Only objects created before timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "updated",
                    "float",
                    "Only objects updated on timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "updated_from",
                    "float",
                    "Only objects updated from timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "updated_to",
                    "float",
                    "Only objects updated to timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "updated_after",
                    "float",
                    "Only objects updated after timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "updated_before",
                    "float",
                    "Only objects updated before timestamp"
                ),
                RouteParamDocumentationDto::new(
                    "title",
                    "string",
                    "Filter by title"
                ),
                RouteParamDocumentationDto::new(
                    "title_contains",
                    "string",
                    "Filter title contains"
                ),
                RouteParamDocumentationDto::new(
                    "ref_ids",
                    "bool",
                    "Include ref ids"
                )
            ],
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    ObjectDto::class . "[]",
                    "Objects"
                ),
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::TEXT,
                    DefaultStatus::_404,
                    null,
                    "Object not found"
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
        return "/object/children/by-import-id/{import_id}";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $children = $this->ilias_rest_api->getChildrenByImportId(
            $request->getParam(
                "import_id"
            ),
            $request->getQueryParam(
                "id"
            ),
            $request->getQueryParam(
                "import_id"
            ),
            $request->getQueryParam(
                "ref_id"
            ),
            ($types = $request->getQueryParam(
                "types"
            )) !== null ? array_map(fn(string $type) : ObjectType => CustomObjectType::factory(
                $type
            ), explode(",", $types)) : null,
            $request->getQueryParam(
                "created"
            ),
            $request->getQueryParam(
                "created_from"
            ),
            $request->getQueryParam(
                "created_to"
            ),
            $request->getQueryParam(
                "created_after"
            ),
            $request->getQueryParam(
                "created_before"
            ),
            $request->getQueryParam(
                "updated"
            ),
            $request->getQueryParam(
                "updated_from"
            ),
            $request->getQueryParam(
                "updated_to"
            ),
            $request->getQueryParam(
                "updated_after"
            ),
            $request->getQueryParam(
                "updated_before"
            ),
            $request->getQueryParam(
                "title"
            ),
            $request->getQueryParam(
                "title_contains"
            ),
            $request->getQueryParam(
                "ref_ids"
            ) === "true",
            false
        );

        if ($children !== null) {
            return ServerResponseDto::new(
                JsonBodyDto::new(
                    $children
                )
            );
        } else {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Object not found"
                ),
                DefaultStatus::_404
            );
        }
    }
}
