<?php

namespace FluxIliasRestApi\Service\FluxIliasRestObject\Command;

use FluxIliasRestApi\Adapter\FluxIliasRestObject\FluxIliasRestObjectApiProxyMapDto;

class GetFluxIliasRestObjectApiProxyMapByKeyCommand
{

    /**
     * @param FluxIliasRestObjectApiProxyMapDto[] $api_proxy_maps
     */
    private function __construct(
        private readonly array $api_proxy_maps
    ) {

    }


    /**
     * @param FluxIliasRestObjectApiProxyMapDto[] $api_proxy_maps
     */
    public static function new(
        array $api_proxy_maps
    ) : static {
        return new static(
            $api_proxy_maps
        );
    }


    public function getFluxIliasRestObjectApiProxyMapByKey(string $key) : ?FluxIliasRestObjectApiProxyMapDto
    {
        foreach ($this->api_proxy_maps as $api_proxy_map) {
            if ($api_proxy_map->key === $key) {
                return $api_proxy_map;
            }
        }

        return null;
    }
}
