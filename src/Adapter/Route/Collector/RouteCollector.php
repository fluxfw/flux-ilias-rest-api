<?php

namespace FluxIliasRestApi\Adapter\Route\Collector;

use FluxIliasRestApi\Adapter\Route\Route;

interface RouteCollector
{

    /**
     * @return Route[]
     */
    public function collectRoutes() : array;
}
