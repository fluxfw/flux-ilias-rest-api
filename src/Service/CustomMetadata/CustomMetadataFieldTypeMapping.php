<?php

namespace FluxIliasRestApi\Service\CustomMetadata;

use FluxIliasBaseApi\Adapter\CustomMetadata\CustomCustomMetadataFieldType;
use FluxIliasBaseApi\Adapter\CustomMetadata\CustomMetadataFieldType;
use FluxIliasBaseApi\Adapter\CustomMetadata\DefaultCustomMetadataFieldType;

class CustomMetadataFieldTypeMapping
{

    public static function mapExternalToInternal(CustomMetadataFieldType $type) : InternalCustomMetadataFieldType
    {
        return CustomInternalCustomMetadataFieldType::factory(
            array_flip(static::INTERNAL_EXTERNAL())[$type->value] ?? substr($type->value, 1)
        );
    }


    public static function mapInternalToExternal(InternalCustomMetadataFieldType $type) : CustomMetadataFieldType
    {
        return CustomCustomMetadataFieldType::factory(
            static::INTERNAL_EXTERNAL()[$type->value] ?? "_" . $type->value
        );
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            DefaultInternalCustomMetadataFieldType::FLOAT->value        => DefaultCustomMetadataFieldType::FLOAT->value,
            DefaultInternalCustomMetadataFieldType::INTEGER->value      => DefaultCustomMetadataFieldType::INTEGER->value,
            DefaultInternalCustomMetadataFieldType::SELECT->value       => DefaultCustomMetadataFieldType::SINGLE_CHOICE->value,
            DefaultInternalCustomMetadataFieldType::SELECT_MULTI->value => DefaultCustomMetadataFieldType::MULTIPLE_CHOICE->value,
            DefaultInternalCustomMetadataFieldType::TEXT->value         => DefaultCustomMetadataFieldType::TEXT->value
        ];
    }
}
