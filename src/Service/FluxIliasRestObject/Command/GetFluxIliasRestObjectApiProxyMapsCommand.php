<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetFluxIliasRestObjectApiProxyMapsCommand
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    /**
     * @return FluxIliasRestObjectApiProxyMapDto[]
     */
    public function getFluxIliasRestObjectApiProxyMaps() : array
    {
        return array_map([FluxIliasRestObjectApiProxyMapDto::class, "newFromObject"], (array) $this->config_service->getConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS
        ));
    }
}
