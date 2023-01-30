<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;
use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetFluxIliasRestObjectApiProxyMapsCommand
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
     * @param FluxIliasRestObjectApiProxyMapDto[] $api_proxy_maps
     */
    public function setFluxIliasRestObjectApiProxyMaps(array $api_proxy_maps) : void
    {
        $this->config_service->setConfig(
            ConfigKey::FLUX_ILIAS_REST_OBJECT_API_PROXY_MAPS,
            $api_proxy_maps
        );
    }
}
