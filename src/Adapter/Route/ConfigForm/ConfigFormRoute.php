<?php

namespace FluxIliasRestApi\Adapter\Route\ConfigForm;

use FluxIliasRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ilGlobalTemplateInterface;

class ConfigFormRoute implements Route
{

    private function __construct(
        private readonly ProxyService $proxy_service,
        private readonly ilGlobalTemplateInterface $ilias_global_template
    ) {

    }


    public static function new(
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template
    ) : static {
        return new static(
            $proxy_service,
            $ilias_global_template
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
        return "/";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        return ServerResponseDto::new(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    "flux-ilias-rest-config",
                    "flux-ilias-rest-config",
                    "flux-ilias-rest",
                    "config",
                    "/ui/flilre_config.html",
                    null,
                    $request->original_route,
                    "flux-ilias-rest-config"
                )
            )
        );
    }
}
