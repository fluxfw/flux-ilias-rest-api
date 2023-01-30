<?php

namespace FluxIliasRestApi\Adapter\Route\ConfigForm;

use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;

class GetConfigFormValuesRoute implements Route
{

    private function __construct(
        private readonly ConfigFormService $config_form_service
    ) {

    }


    public static function new(
        ConfigFormService $config_form_service
    ) : static {
        return new static(
            $config_form_service
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
                $this->config_form_service->getConfigFormValues()
            )
        );
    }
}
