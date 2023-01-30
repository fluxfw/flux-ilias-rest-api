<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Command;

use FluxIliasRestApi\Adapter\Proxy\ApiProxyMapDto;

class GetApiProxyMapByKeyCommand
{

    /**
     * @param ApiProxyMapDto[] $api_proxy_map
     */
    private function __construct(
        private readonly array $api_proxy_map
    ) {

    }


    /**
     * @param ApiProxyMapDto[] $api_proxy_map
     */
    public static function new(
        array $api_proxy_map
    ) : static {
        return new static(
            $api_proxy_map
        );
    }


    public function getApiProxyMapByKey(string $target_key) : ?ApiProxyMapDto
    {
        foreach ($this->api_proxy_map as $api_proxy_map) {
            if ($api_proxy_map->target_key === $target_key) {
                return $api_proxy_map;
            }
        }

        return null;
    }
}
