<?php

namespace FluxIliasRestApi\Adapter\Proxy;

class WebProxyMapDto
{

    private function __construct(
        public readonly string $target_key,
        public readonly string $iframe_url,
        public readonly string $page_title,
        public readonly string $short_title,
        public readonly string $view_title,
        public readonly ?string $rewrite_url,
        public readonly bool $menu_item,
        public readonly ?string $menu_title,
        public readonly ?string $menu_icon_url,
        public readonly bool $visible_public_menu_item,
        public readonly bool $visible_administrator_role_only_menu_item
    ) {

    }


    public static function new(
        string $target_key,
        string $iframe_url,
        string $page_title,
        string $short_title,
        string $view_title,
        ?string $rewrite_url,
        ?bool $menu_item,
        ?string $menu_title,
        ?string $menu_icon_url,
        ?bool $visible_public_menu_item,
        ?bool $visible_administrator_role_only_menu_item
    ) : static {
        return new static(
            $target_key,
            $iframe_url,
            $page_title,
            $short_title,
            $view_title,
            $rewrite_url,
            $menu_item ?? false,
            $menu_title,
            $menu_icon_url,
            $visible_public_menu_item ?? false,
            $visible_administrator_role_only_menu_item ?? false
        );
    }


    public static function newFromObject(
        object $web_proxy_map
    ) : static {
        return static::new(
            $web_proxy_map->target_key ?? "",
            $web_proxy_map->iframe_url ?? "",
            $web_proxy_map->page_title ?? "",
            $web_proxy_map->short_title ?? "",
            $web_proxy_map->view_title ?? "",
            ($web_proxy_map->rewrite_url ?? null) ?: null,
            $web_proxy_map->menu_item ?? null,
            ($web_proxy_map->menu_title ?? null) ?: null,
            ($web_proxy_map->menu_icon_url ?? null) ?: null,
            $web_proxy_map->visible_public_menu_item ?? null,
            $web_proxy_map->visible_administrator_role_only_menu_item ?? null
        );
    }


    public function getMenuTitleWithDefault() : string
    {
        return $this->menu_title ?? $this->target_key;
    }


    public function getRewriteUrlWithDefault() : string
    {
        return $this->rewrite_url ?? "/flux-ilias-rest-web-proxy/" . rawurlencode($this->target_key);
    }
}
