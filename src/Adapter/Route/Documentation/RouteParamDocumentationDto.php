<?php

namespace FluxIliasRestApi\Adapter\Route\Documentation;

class RouteParamDocumentationDto
{

    private function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $description
    ) {

    }


    public static function new(
        string $name,
        ?string $type = null,
        ?string $description = null
    ) : static {
        return new static(
            $name,
            $type ?? "",
            $description ?? ""
        );
    }
}
