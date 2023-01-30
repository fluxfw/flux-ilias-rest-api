<?php

namespace FluxIliasRestApi\Adapter\Route\ConfigForm;

use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxRestApi\Adapter\Body\JsonBodyDto;
use FluxRestApi\Adapter\Body\TextBodyDto;
use FluxRestApi\Adapter\Method\DefaultMethod;
use FluxRestApi\Adapter\Method\Method;
use FluxRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxRestApi\Adapter\Route\Route;
use FluxRestApi\Adapter\Server\ServerRequestDto;
use FluxRestApi\Adapter\Server\ServerResponseDto;
use FluxRestApi\Adapter\Status\DefaultStatus;

class StoreConfigFormValuesRoute implements Route
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
        return DefaultMethod::POST;
    }


    public function getRoute() : string
    {
        return "/store-values";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        if (!($request->parsed_body instanceof JsonBodyDto)) {
            return ServerResponseDto::new(
                TextBodyDto::new(
                    "No json body"
                ),
                DefaultStatus::_400
            );
        }

        return ServerResponseDto::new(
            JsonBodyDto::new(
                $this->config_form_service->storeConfigFormValues(
                    $request->parsed_body->data
                )
            )
        );
    }
}
