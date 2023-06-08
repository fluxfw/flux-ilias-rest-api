<?php

namespace FluxIliasRestApi\Adapter\Group;

use FluxIliasRestApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class GroupDto implements JsonSerializable
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
        object $group
    ) : static {
        return static::new(
            $group->id ?? null,
            $group->import_id ?? null,
            $group->ref_id ?? null,
            $group->created ?? null,
            $group->updated ?? null,
            $group->parent_id ?? null,
            $group->parent_import_id ?? null,
            $group->parent_ref_id ?? null,
            $group->url ?? null,
            $group->icon_url ?? null,
            $group->title ?? null,
            $group->description ?? null,
            $group->didactic_template_id ?? null,
            $group->in_trash ?? null,
            ($custom_metadata = $group->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromObject"], $custom_metadata) : null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
