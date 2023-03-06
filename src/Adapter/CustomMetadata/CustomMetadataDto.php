<?php

namespace FluxIliasRestApi\Adapter\CustomMetadata;

class CustomMetadataDto
{

    private function __construct(
        public readonly ?int $field_id,
        public readonly ?string $field_title,
        public readonly ?int $record_id,
        public readonly ?string $record_title,
        public readonly mixed $value,
        public readonly ?CustomMetadataFieldType $field_type
    ) {

    }


    public static function new(
        ?int $field_id = null,
        ?string $field_title = null,
        ?int $record_id = null,
        ?string $record_title = null,
        mixed $value = null,
        ?CustomMetadataFieldType $field_type = null
    ) : static {
        return new static(
            $field_id,
            $field_title,
            $record_id,
            $record_title,
            $value,
            $field_type
        );
    }


    public static function newFromObject(
        object $custom_metadata
    ) : static {
        return static::new(
            $custom_metadata->field_id ?? null,
            $custom_metadata->field_title ?? null,
            $custom_metadata->record_id ?? null,
            $custom_metadata->record_title ?? null,
            $custom_metadata->value ?? null,
            ($field_type = $custom_metadata->field_type ?? null) !== null ? CustomCustomMetadataFieldType::factory(
                $field_type
            ) : null
        );
    }
}
