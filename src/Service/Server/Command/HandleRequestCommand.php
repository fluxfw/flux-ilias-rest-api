<?php

namespace FluxIliasRestApi\Service\Server\Command;

use FluxIliasRestApi\Adapter\Authorization\Authorization;
use FluxIliasRestApi\Adapter\Body\RawBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;
use FluxIliasRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasRestApi\Adapter\Route\Collector\CombinedRouteCollector;
use FluxIliasRestApi\Adapter\Route\Collector\RouteCollector;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Route\Server\GetDefaultRoute;
use FluxIliasRestApi\Adapter\Route\Server\GetRoutesRoute;
use FluxIliasRestApi\Adapter\Route\Server\GetRoutesUIDefaultRoute;
use FluxIliasRestApi\Adapter\Route\Server\GetRoutesUIFileRoute;
use FluxIliasRestApi\Adapter\Route\Server\MatchedRouteDto;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;
use FluxIliasRestApi\Service\Body\Port\BodyService;
use LogicException;
use Throwable;

class HandleRequestCommand
{

    private readonly RouteCollector $route_collector;
    /**
     * @var Route[]
     */
    private array $routes;


    private function __construct(
        private readonly BodyService $body_service,
        RouteCollector $route_collector,
        private readonly ?Authorization $authorization,
        $routes_ui
    ) {
        $this->route_collector = CombinedRouteCollector::new(
            array_merge($routes_ui ? [
                GetDefaultRoute::new(),
                GetRoutesRoute::new(
                    fn() : array => $this->collectRoutes()
                ),
                GetRoutesUIDefaultRoute::new(),
                GetRoutesUIFileRoute::new()
            ] : [], [
                $route_collector
            ])
        );
    }


    public static function new(
        BodyService $body_service,
        RouteCollector $route_collector,
        ?Authorization $authorization = null,
        bool $routes_ui = false
    ) : static {
        return new static(
            $body_service,
            $route_collector,
            $authorization,
            $routes_ui
        );
    }


    public function handleRequest(ServerRawRequestDto $request) : ServerRawResponseDto
    {
        try {
            $response = $this->handleAuthorization(
                $request
            );
            if ($response !== null) {
                return $this->toRawResponse(
                    $response
                );
            }

            $route = $this->getMatchedRoute(
                $request,
                $this->collectRoutes()
            );
            if ($route instanceof ServerResponseDto) {
                return $this->toRawResponse(
                    $route
                );
            }

            return $this->toRawResponse(
                $this->handleRoute(
                    $route,
                    $request
                )
            );
        } catch (Throwable $ex) {
            file_put_contents("php://stdout", $ex);

            return $this->toRawResponse(
                ServerResponseDto::new(
                    null,
                    DefaultStatus::_500
                )
            );
        }
    }


    /**
     * @return Route[]
     */
    private function collectRoutes() : array
    {
        $this->routes ??= (function () : array {
            $routes = $this->route_collector->collectRoutes();

            usort($routes, fn(Route $route1, Route $route2) : int => strnatcasecmp($route2->getRoute(), $route1->getRoute()));

            return $routes;
        })();

        return $this->routes;
    }


    /**
     * @param Route[] $routes
     */
    private function getMatchedRoute(ServerRawRequestDto $request, array $routes) : MatchedRouteDto|ServerResponseDto
    {
        try {
            if (($request->route[0] ?? null) !== "/") {
                throw new LogicException("Invalid route format " . $request->route);
            }

            $routes = array_filter(array_map(fn(Route $route) : ?MatchedRouteDto => $this->matchRoute(
                $route,
                $request
            ), $routes), fn(?MatchedRouteDto $route) : bool => $route !== null);

            if (empty($routes)) {
                return ServerResponseDto::new(
                    TextBodyDto::new(
                        "Route not found"
                    ),
                    DefaultStatus::_404
                );
            }

            $routes = array_filter($routes,
                fn(MatchedRouteDto $route) : bool => $route->route->getMethod() === $request->method);

            if (empty($routes)) {
                return ServerResponseDto::new(
                    TextBodyDto::new(
                        "Invalid method"
                    ),
                    DefaultStatus::_405
                );
            }

            if (count($routes) > 1) {
                throw new LogicException("Multiple routes found for route " . $request->route . " and method " . $request->method->value);
            }

            return current($routes);
        } catch (Throwable $ex) {
            file_put_contents("php://stdout", $ex);

            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Invalid route"
                ),
                DefaultStatus::_400
            );
        }
    }


    private function handleAuthorization(ServerRawRequestDto $request) : ?ServerResponseDto
    {
        if ($this->authorization === null) {
            return null;
        }

        return $this->authorization->authorize(
            $request
        );
    }


    private function handleRoute(MatchedRouteDto $route, ServerRawRequestDto $request) : ServerResponseDto
    {
        try {
            $request = ServerRequestDto::new(
                $request->route,
                $request->original_route,
                $request->method,
                $request->query_params,
                $request->body,
                $request->headers,
                $request->cookies,
                $route->params,
                $this->body_service->parseBody(
                    RawBodyDto::new(
                        $request->getHeader(
                            DefaultHeaderKey::CONTENT_TYPE
                        ),
                        $request->body
                    ),
                    $request->post,
                    $request->files
                )
            );
        } catch (Throwable $ex) {
            file_put_contents("php://stdout", $ex);

            return ServerResponseDto::new(
                TextBodyDto::new(
                    "Invalid body"
                ),
                DefaultStatus::_400
            );
        }

        return $route->route->handle(
                $request
            ) ?? ServerResponseDto::new();
    }


    private function matchRoute(Route $route, ServerRawRequestDto $request) : ?MatchedRouteDto
    {
        $param_keys = [];
        $param_values = [];
        preg_match("/^" . preg_replace_callback("/\\\{([A-Za-z0-9-_]+)(\\\\\.)?\\\}/", function (array $matches) use (&$param_keys) {
                $param_keys[] = $matches[1];

                if (isset($matches[2]) && $matches[2] === "\\.") {
                    return "([A-Za-z0-9-_.\/]+)";
                } else {
                    return "([A-Za-z0-9-_.]+)";
                }
            }, preg_quote($this->normalizeRoute(
                $route->getRoute()
            ), "/")) . "$/", $this->normalizeRoute(
            $request->route
        ), $param_values);

        if (empty($param_values) || count($param_values) < 1) {
            return null;
        }

        array_shift($param_values);

        if (count($param_keys) !== count($param_values)) {
            throw new LogicException("Count of param keys and values are not the same");
        }

        return MatchedRouteDto::new(
            $route,
            array_combine($param_keys, array_map([$this, "removeNormalizeRoute"], $param_values))
        );
    }


    private function normalizeRoute(string $route) : string
    {
        return "/" . $this->removeNormalizeRoute(
                $route
            );
    }


    private function removeNormalizeRoute(string $route) : string
    {
        return trim(preg_replace("/\.+/", ".", preg_replace("/\/+/", "/", $route)), "/");
    }


    private function toRawResponse(ServerResponseDto $response) : ServerRawResponseDto
    {
        if ($response->sendfile !== null && ($response->body !== null || $response->raw_body !== null)) {
            throw new LogicException("Can't set both body and sendfile");
        }

        if ($response->body === null) {
            return ServerRawResponseDto::new(
                $response->raw_body,
                $response->status,
                $response->headers,
                $response->cookies,
                $response->sendfile
            );
        }

        if ($response->raw_body !== null) {
            throw new LogicException("Can't set both body and raw body");
        }

        $raw_body = $this->body_service->toRawBody(
            $response->body
        );

        return ServerRawResponseDto::new(
            $raw_body->body,
            $response->status,
            $response->headers + [
                DefaultHeaderKey::CONTENT_TYPE->value => $raw_body->type
            ],
            $response->cookies,
            $response->sendfile
        );
    }
}
