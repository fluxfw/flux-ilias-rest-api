<?php

namespace FluxIliasRestApi\Adapter\FluxIliasRestObject;

class FluxIliasRestObjectDiffDto
{

    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $web_proxy_map_key,
        public readonly ?string $api_proxy_map_key
    ) {

    }


    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?string $web_proxy_map_key = null,
        ?string $api_proxy_map_key = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description,
            $web_proxy_map_key,
            $api_proxy_map_key
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->web_proxy_map_key ?? null,
            $diff->api_proxy_map_key ?? null
        );
    }
}
