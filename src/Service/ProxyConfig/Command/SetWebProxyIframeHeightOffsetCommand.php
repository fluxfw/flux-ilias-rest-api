<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetWebProxyIframeHeightOffsetCommand
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


    public function setWebProxyIframeHeightOffset(?int $web_proxy_iframe_height_offset) : void
    {
        $this->config_service->setConfig(
            ConfigKey::WEB_PROXY_IFRAME_HEIGHT_OFFSET,
            max(0, $web_proxy_iframe_height_offset ?? GetWebProxyIframeHeightOffsetCommand::DEFAULT_VALUE)
        );
    }
}
