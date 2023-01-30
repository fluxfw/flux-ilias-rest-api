<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Command;

use FluxIliasRestApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetApiProxyMapCommand
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
     * @param ApiProxyMapDto[] $api_proxy_map
     */
    public function setApiProxyMap(array $api_proxy_map) : void
    {
        $this->config_service->setConfig(
            ConfigKey::API_PROXY_MAP,
            $api_proxy_map
        );
    }
}
