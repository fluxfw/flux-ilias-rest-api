<?php

namespace FluxIliasRestApi\Adapter\Proxy;

class ApiProxyMapDto
{

    private function __construct(
        public readonly string $target_key,
        public readonly string $url
    ) {

    }


    public static function new(
        string $target_key,
        string $url
    ) : static {
        return new static(
            $target_key,
            $url
        );
    }


    public static function newFromObject(
        object $api_proxy_map
    ) : static {
        return static::new(
            $api_proxy_map->target_key ?? "",
            $api_proxy_map->url ?? ""
        );
    }
}
