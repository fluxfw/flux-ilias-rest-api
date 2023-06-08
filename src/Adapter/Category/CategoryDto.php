<?php

namespace FluxIliasRestApi\Adapter\Category;

use FluxIliasRestApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class CategoryDto implements JsonSerializable
{

    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?float $created,
        public readonly ?float $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $icon_url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $didactic_template_id,
        public readonly ?bool $in_trash,
        public readonly ?array $custom_metadata
    ) {

    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?float $created = null,
        ?float $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null,
        ?bool $in_trash = null,
        ?array $custom_metadata = null
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
            $didactic_template_id,
            $in_trash,
            $custom_metadata
        );
    }


    public static function newFromObject(
        object $category
    ) : static {
        return static::new(
            $category->id ?? null,
            $category->import_id ?? null,
            $category->ref_id ?? null,
            $category->created ?? null,
            $category->updated ?? null,
            $category->parent_id ?? null,
            $category->parent_import_id ?? null,
            $category->parent_ref_id ?? null,
            $category->url ?? null,
            $category->icon_url ?? null,
            $category->title ?? null,
            $category->description ?? null,
            $category->didactic_template_id ?? null,
            $category->in_trash ?? null,
            ($custom_metadata = $category->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromObject"], $custom_metadata) : null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
