<?php

namespace FluxIliasRestApi\Service\CustomMetadata;

enum DefaultInternalCustomMetadataFieldType: int implements InternalCustomMetadataFieldType
{

    case FLOAT = 6;
    case INTEGER = 5;
    case SELECT = 1;
    case SELECT_MULTI = 8;
    case TEXT = 2;
}
