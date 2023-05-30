<?php

namespace FluxIliasRestApi\Adapter\Route\Server;

use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteResponseDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

class GetRoutesRoute implements Route
{

    /**
     * @param callable $get_routes
     */
    private function __construct(
        private readonly mixed $get_routes
    ) {

    }


    public static function new(
        callable $get_routes
    ) : static {
        return new static(
            $get_routes
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return RouteDocumentationDto::new(
            $this->getRoute(),
            $this->getMethod(),
            "Get routes",
            null,
            null,
            null,
            null,
            [
                RouteResponseDocumentationDto::new(
                    DefaultBodyType::JSON,
                    null,
                    RouteDocumentationDto::class . "[]",
                    "Routes"
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
        return "/routes";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $getRoute = function (string $route) use ($request) : string {
            $original_route = trim(dirname($request->original_route), "/");
            if (!empty($original_route)) {
                $original_route = "/" . $original_route . "/";
            } else {
                $original_route = "/";
            }

            $route = $original_route . trim($route, "/");
            if (empty($route) || $route === "/") {
                return "/";
            }

            return rtrim($route, "/");
        };

        $route_documentations = array_map(fn(Route $route) : RouteDocumentationDto => ($route_documentation = $route->getDocumentation()) !== null
            ? RouteDocumentationDto::new(
                $getRoute($route_documentation->route),
                $route_documentation->method,
                $route_documentation->title,
                $route_documentation->description,
                $route_documentation->route_params,
                $route_documentation->query_params,
                $route_documentation->content_types,
                $route_documentation->responses
            )
            : RouteDocumentationDto::new(
                $getRoute($route->getRoute()),
                $route->getMethod(),
                null,
                "Documentation is missing"
            ), ($this->get_routes)());

        usort($route_documentations, function (RouteDocumentationDto $route_documentation1, RouteDocumentationDto $route_documentation2) : int {
            $sort = strnatcasecmp($route_documentation1->route, $route_documentation2->route);
            if ($sort !== 0) {
                return $sort;
            }

            return strnatcasecmp($route_documentation1->method->value, $route_documentation2->method->value);
        });

        return ServerResponseDto::new(
            JsonBodyDto::new(
                $route_documentations
            )
        );
    }
}
