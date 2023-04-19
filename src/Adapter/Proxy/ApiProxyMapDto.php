<?php

namespace FluxIliasRestApi\Adapter\Proxy;

class ApiProxyMapDto
{

    private function __construct(
        public readonly string $target_key,
        public readonly string $url,
        public readonly ?string $user,
        public readonly ?string $password
    ) {

    }


    public static function new(
        string $target_key,
        string $url,
        ?string $user,
        ?string $password
    ) : static {
        return new static(
            $target_key,
            $url,
            $user,
            $password
        );
    }


    public static function newFromObject(
        object $api_proxy_map
    ) : static {
        return static::new(
            $api_proxy_map->target_key ?? "",
            $api_proxy_map->url ?? "",
            ($api_proxy_map->user ?? null) ?: null,
            ($api_proxy_map->password ?? null) ?: null
        );
    }
}
