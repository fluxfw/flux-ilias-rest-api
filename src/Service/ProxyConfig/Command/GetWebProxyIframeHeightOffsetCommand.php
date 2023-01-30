<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class GetWebProxyIframeHeightOffsetCommand
{

    public const DEFAULT_VALUE = 220;


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


    public function getWebProxyIframeHeightOffset() : int
    {
        return intval($this->config_service->getConfig(
            ConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET
        ) ?? static::DEFAULT_VALUE);
    }
}
