<?php

namespace FluxIliasRestApi\Service\ProxyConfig\Command;

use FluxIliasRestApi\Adapter\Proxy\WebProxyMapDto;

class GetWebProxyMapByKeyCommand
{

    /**
     * @param WebProxyMapDto[] $web_proxy_map
     */
    private function __construct(
        private readonly array $web_proxy_map
    ) {

    }


    /**
     * @param WebProxyMapDto[] $web_proxy_map
     */
    public static function new(
        array $web_proxy_map
    ) : static {
        return new static(
            $web_proxy_map
        );
    }


    public function getWebProxyMapByKey(string $target_key) : ?WebProxyMapDto
    {
        foreach ($this->web_proxy_map as $web_proxy_map) {
            if ($web_proxy_map->target_key === $target_key) {
                return $web_proxy_map;
            }
        }

        return null;
    }
}
