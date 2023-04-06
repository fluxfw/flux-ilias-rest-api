<?php

namespace FluxIliasRestApi\Adapter\CustomMetadata;

enum DefaultCustomMetadataFieldType: string implements CustomMetadataFieldType
{

    case FLOAT = "float";
    case INTEGER = "integer";
    case MULTIPLE_CHOICE = "multiple-choice";
    case SINGLE_CHOICE = "single-choice";
    case TEXT = "text";
}
