<?php

namespace FluxIliasRestApi\Adapter\Route\ConfigForm;

use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use FluxRestApi\Adapter\Route\Collector\RouteCollector;
use ilGlobalTemplateInterface;

class ConfigFormRouteCollector implements RouteCollector
{

    private function __construct(
        private readonly ConfigFormService $config_form_service,
        private readonly ProxyService $proxy_service,
        private readonly ilGlobalTemplateInterface $ilias_global_template
    ) {

    }


    public static function new(
        ConfigFormService $config_form_service,
        ProxyService $proxy_service,
        ilGlobalTemplateInterface $ilias_global_template
    ) : static {
        return new static(
            $config_form_service,
            $proxy_service,
            $ilias_global_template
        );
    }


    public function collectRoutes() : array
    {
        return [
            ConfigFormRoute::new(
                $this->proxy_service,
                $this->ilias_global_template
            ),
            GetConfigFormValuesRoute::new(
                $this->config_form_service
            ),
            StoreConfigFormValuesRoute::new(
                $this->config_form_service
            )
        ];
    }
}
