<?php

namespace FluxIliasRestApi\Adapter\Route\Documentation;

use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;

class RouteDocumentationDto
{

    /**
     * @param RouteParamDocumentationDto[]       $route_params
     * @param RouteParamDocumentationDto[]       $query_params
     * @param RouteContentTypeDocumentationDto[] $content_types
     * @param RouteResponseDocumentationDto[]    $responses
     */
    private function __construct(
        public readonly string $route,
        public readonly Method $method,
        public readonly string $title,
        public readonly string $description,
        public readonly array $route_params,
        public readonly array $query_params,
        public readonly array $content_types,
        public readonly array $responses
    ) {

    }


    /**
     * @param RouteParamDocumentationDto[]       $route_params
     * @param RouteParamDocumentationDto[]       $query_params
     * @param RouteContentTypeDocumentationDto[] $content_types
     * @param RouteResponseDocumentationDto[]    $responses
     */
    public static function new(
        string $route,
        ?Method $method = null,
        ?string $title = null,
        ?string $description = null,
        ?array $route_params = null,
        ?array $query_params = null,
        ?array $content_types = null,
        ?array $responses = null
    ) : static {
        return new static(
            $route,
            $method ?? DefaultMethod::GET,
            $title ?? "",
            $description ?? "",
            $route_params ?? [],
            $query_params ?? [],
            $content_types ?? [],
            $responses ?? []
        );
    }
}
