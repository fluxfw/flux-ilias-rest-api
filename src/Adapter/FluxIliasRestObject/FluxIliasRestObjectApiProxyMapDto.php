<?php

namespace FluxIliasRestApi\Adapter\FluxIliasRestObject;

class FluxIliasRestObjectApiProxyMapDto
{

    private function __construct(
        public readonly string $key,
        public readonly string $url
    ) {

    }


    public static function new(
        string $key,
        string $url
    ) : static {
        return new static(
            $key,
            $url
        );
    }


    public static function newFromObject(
        object $api_proxy_map
    ) : static {
        return static::new(
            $api_proxy_map->key ?? "",
            $api_proxy_map->url ?? ""
        );
    }
}
