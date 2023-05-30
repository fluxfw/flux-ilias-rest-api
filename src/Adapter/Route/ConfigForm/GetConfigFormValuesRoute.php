<?php

namespace FluxIliasRestApi\Adapter\Route\ConfigForm;

use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;

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
