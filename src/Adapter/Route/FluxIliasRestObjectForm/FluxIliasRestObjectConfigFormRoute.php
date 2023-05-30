<?php

namespace FluxIliasRestApi\Adapter\Route\FluxIliasRestObjectForm;

use FluxIliasRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;
use FluxIliasRestApi\Adapter\Route\Documentation\RouteDocumentationDto;
use FluxIliasRestApi\Adapter\Route\Route;
use FluxIliasRestApi\Adapter\Server\ServerRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerResponseDto;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ilGlobalTemplateInterface;
use ilLocatorGUI;

class FluxIliasRestObjectConfigFormRoute implements Route
{

    private function __construct(
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ProxyService $proxy_service,
        private readonly ilGlobalTemplateInterface $ilias_global_template,
        private readonly ilLocatorGUI $ilias_locator,
        private readonly FluxIliasRestObjectDto $object
    ) {

    }


    public static function new(
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template,
        ilLocatorGUI $ilias_locator,
        FluxIliasRestObjectDto $object
    ) : static {
        return new static(
            $flux_ilias_rest_object_service,
            $proxy_service,
            $ilias_global_template,
            $ilias_locator,
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
        return "/";
    }


    public function handle(ServerRequestDto $request) : ?ServerResponseDto
    {
        $this->ilias_locator->addRepositoryItems($this->object->ref_id);
        $this->ilias_locator->addItem($this->object->title, $link = $this->flux_ilias_rest_object_service->getFluxIliasRestObjectConfigLink(
            $this->object->ref_id
        ));

        return ServerResponseDto::new(
            HtmlBodyDto::new(
                $this->proxy_service->getWebProxy(
                    $this->ilias_global_template,
                    "flux-ilias-rest-object-config",
                    "flux-ilias-rest-object-config",
                    "flux-ilias-rest",
                    "object-config",
                    "/ui/flilre_object_config.html",
                    [
                        "ref_id" => $this->object->ref_id
                    ],
                    $request->original_route,
                    $link
                )
            )
        );
    }
}
