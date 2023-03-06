<?php

namespace FluxIliasRestApi\Adapter\FluxIliasRestObject;

use JsonSerializable;

class FluxIliasRestObjectDto implements JsonSerializable
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?int $created,
        public readonly ?int $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $icon_url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $web_proxy_map_key,
        public readonly ?string $api_proxy_map_key,
        public readonly ?bool $in_trash
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?string $web_proxy_map_key = null,
        ?string $api_proxy_map_key = null,
        ?bool $in_trash = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $title,
            $description,
            $web_proxy_map_key,
            $api_proxy_map_key,
            $in_trash
        );
    }


    public static function newFromObject(
        object $object
    ) : static {
        return static::new(
            $object->id ?? null,
            $object->import_id ?? null,
            $object->ref_id ?? null,
            $object->created ?? null,
            $object->updated ?? null,
            $object->parent_id ?? null,
            $object->parent_import_id ?? null,
            $object->parent_ref_id ?? null,
            $object->url ?? null,
            $object->icon_url ?? null,
            $object->title ?? null,
            $object->description ?? null,
            $object->web_proxy_map_key ?? null,
            $object->api_proxy_map_key ?? null,
            $object->in_trash ?? null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
