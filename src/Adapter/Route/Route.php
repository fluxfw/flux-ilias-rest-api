<?php

namespace FluxIliasRestApi\Adapter\Route;

use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;

interface Route
{

    public function getDocumentation() : ?RouteDocumentationDto;


    public function getMethod() : Method;


    public function getRoute() : string;


    public function handle(ServerRequestDto $request) : ?ServerResponseDto;
}
