<?php

namespace FluxIliasRestApi\Adapter\Route\Server;

use FluxIliasRestApi\Adapter\Route\Route;

class MatchedRouteDto
{

    /**
     * @param string[] $params
     */
    private function __construct(
        public readonly Route $route,
        public readonly array $params
    ) {

    }


    /**
     * @param string[]|null $params
     */
    public static function new(
        Route $route,
        ?array $params
    ) : static {
        return new static(
            $route,
            $params ?? []
        );
    }
}
