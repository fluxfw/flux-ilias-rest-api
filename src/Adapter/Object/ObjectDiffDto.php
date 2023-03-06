<?php

namespace FluxIliasRestApi\Adapter\Object;

use FluxIliasRestApi\Adapter\CustomMetadata\CustomMetadataDto;

class ObjectDiffDto
{

    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        public readonly ?string $import_id,
        public readonly ?bool $online,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $didactic_template_id,
        public readonly ?array $custom_metadata
    ) {

    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?string $import_id = null,
        ?bool $online = null,
        ?string $title = null,
        ?string $description = null,
        ?int $didactic_template_id = null,
        ?array $custom_metadata = null
    ) : static {
        return new static(
            $import_id,
            $online,
            $title,
            $description,
            $didactic_template_id,
            $custom_metadata
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->online ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->didactic_template_id ?? null,
            ($custom_metadata = $diff->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromObject"], $custom_metadata) : null
        );
    }
}
