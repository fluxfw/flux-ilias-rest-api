<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Port;

use FluxIliasRestApi\Adapter\Proxy\ApiProxyMapDto;
use FluxIliasRestApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasRestApi\Service\Config\Port\ConfigService;
use FluxIliasRestApi\Service\ProxyConfig\Command\GetApiProxyMapByKeyCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\GetApiProxyMapCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\GetWebProxyIframeHeightOffsetCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\GetWebProxyMapByKeyCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\GetWebProxyMapCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\SetApiProxyMapCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\SetWebProxyIframeHeightOffsetCommand;
use FluxIliasRestApi\Service\ProxyConfig\Command\SetWebProxyMapCommand;

class ProxyConfigService
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
     * @return ApiProxyMapDto[]
     */
    public function getApiProxyMap() : array
    {
        return GetApiProxyMapCommand::new(
            $this->config_service
        )
            ->getApiProxyMap();
    }


    public function getApiProxyMapByKey(string $target_key) : ?ApiProxyMapDto
    {
        return GetApiProxyMapByKeyCommand::new(
            $this->getApiProxyMap()
        )
            ->getApiProxyMapByKey(
                $target_key
            );
    }


    public function getWebProxyIframeHeightOffset() : int
    {
        return GetWebProxyIframeHeightOffsetCommand::new(
            $this->config_service
        )
            ->getWebProxyIframeHeightOffset();
    }


    /**
     * @return WebProxyMapDto[]
     */
    public function getWebProxyMap() : array
    {
        return GetWebProxyMapCommand::new(
            $this->config_service
        )
            ->getWebProxyMap();
    }


    public function getWebProxyMapByKey(string $target_key) : ?WebProxyMapDto
    {
        return GetWebProxyMapByKeyCommand::new(
            $this->getWebProxyMap()
        )
            ->getWebProxyMapByKey(
                $target_key
            );
    }


    /**
     * @param ApiProxyMapDto[] $api_proxy_map
     */
    public function setApiProxyMap(array $api_proxy_map) : void
    {
        SetApiProxyMapCommand::new(
            $this->config_service
        )
            ->setApiProxyMap(
                $api_proxy_map
            );
    }


    public function setWebProxyIframeHeightOffset(?int $web_proxy_iframe_height_offset) : void
    {
        SetWebProxyIframeHeightOffsetCommand::new(
            $this->config_service
        )
            ->setWebProxyIframeHeightOffset(
                $web_proxy_iframe_height_offset
            );
    }


    /**
     * @param WebProxyMapDto[] $web_proxy_map
     */
    public function setWebProxyMap(array $web_proxy_map) : void
    {
        SetWebProxyMapCommand::new(
            $this->config_service
        )
            ->setWebProxyMap(
                $web_proxy_map
            );
    }
}
