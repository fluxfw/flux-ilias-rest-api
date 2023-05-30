<?php

namespace FluxIliasRestApi\Adapter\Route\FluxIliasRestObjectForm;

use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;

class GetFluxIliasRestObjectConfigFormValuesRoute implements Route
{

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly FluxIliasRestObjectDto $object
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        FluxIliasRestObjectDto $object
    ) : static {
        return new static(
            $flux_ilias_rest_object_service,
            $object
        );
    }


    public function getDocumentation() : ?RouteDocumentationDto
    {
        return null;
    }


    public function getMethod() : Method
    {
        return DefaultMethod::GET;
    }


    public function getRoute() : string
    {
        return "/get-values";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->flux_ilias_rest_object_service->getFluxIliasRestObjectConfigFormValues(
                    $this->object
                )
            )
        );
    }
}
