<?php

namespace FluxIliasRestApi\Adapter\Route\Documentation;

use FluxIliasRestApi\Adapter\Body\Type\BodyType;

class RouteContentTypeDocumentationDto
{

    private function __construct(
        public readonly ?BodyType $content_type,
        public readonly string $type,
        public readonly string $description
    ) {

    }


    public static function new(
        ?BodyType $content_type = null,
        ?string $type = null,
        ?string $description = null
    ) : static {
        return new static(
            $content_type,
            $type ?? "",
            $description ?? ""
        );
    }
}
