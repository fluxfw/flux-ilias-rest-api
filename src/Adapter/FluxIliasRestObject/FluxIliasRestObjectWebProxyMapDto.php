<?php

namespace FluxIliasRestApi\Adapter\FluxIliasRestObject;

class FluxIliasRestObjectWebProxyMapDto
{

    private function __construct(
        public readonly string $key,
        public readonly string $iframe_url,
        public readonly string $page_title,
        public readonly string $short_title,
        public readonly string $view_title,
        public readonly bool $pass_ref_id,
        public readonly ?string $icon_url,
        public readonly ?string $rewrite_url
    ) {

    }


    public static function new(
        string $key,
        string $iframe_url,
        string $page_title,
        string $short_title,
        string $view_title,
        ?bool $pass_ref_id,
        ?string $icon_url,
        ?string $rewrite_url
    ) : static {
        return new static(
            $key,
            $iframe_url,
            $page_title,
            $short_title,
            $view_title,
            $pass_ref_id ?? false,
            $icon_url,
            $rewrite_url
        );
    }


    public static function newFromObject(
        object $web_proxy_map
    ) : static {
        return static::new(
            $web_proxy_map->key ?? "",
            $web_proxy_map->iframe_url ?? "",
            $web_proxy_map->page_title ?? "",
            $web_proxy_map->short_title ?? "",
            $web_proxy_map->view_title ?? "",
            $web_proxy_map->pass_ref_id ?? null,
            ($web_proxy_map->icon_url ?? null) ?: null,
            ($web_proxy_map->rewrite_url ?? null) ?: null
        );
    }
}
