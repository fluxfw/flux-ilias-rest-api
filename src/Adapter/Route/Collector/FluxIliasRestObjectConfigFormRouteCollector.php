<?php

namespace FluxIliasRestApi\Adapter\Route\Collector;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectDto;
use FluxIliasRestApi\Adapter\Route\FluxIliasRestObjectForm\FluxIliasRestObjectConfigFormRoute;
use FluxIliasRestApi\Adapter\Route\FluxIliasRestObjectForm\GetFluxIliasRestObjectConfigFormValuesRoute;
use FluxIliasRestApi\Adapter\Route\FluxIliasRestObjectForm\StoreFluxIliasRestObjectConfigFormValuesRoute;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ilGlobalTemplateInterface;
use ilLocatorGUI;

class FluxIliasRestObjectConfigFormRouteCollector implements RouteCollector
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


    public function collectRoutes() : array
    {
        return [
            FluxIliasRestObjectConfigFormRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->proxy_service,
                $this->ilias_global_template,
                $this->ilias_locator,
                $this->object
            ),
            GetFluxIliasRestObjectConfigFormValuesRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->object
            ),
            StoreFluxIliasRestObjectConfigFormValuesRoute::new(
                $this->flux_ilias_rest_object_service,
                $this->object
            )
        ];
    }
}
