<?php

namespace FluxIliasRestApi\Adapter\Route\Documentation;

use FluxIliasRestApi\Adapter\Body\Type\BodyType;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;
use FluxIliasRestApi\Adapter\Status\Status;

class RouteResponseDocumentationDto
{

    private function __construct(
        public readonly ?BodyType $content_type,
        public readonly Status $status,
        public readonly string $type,
        public readonly string $description
    ) {

    }


    public static function new(
        ?BodyType $content_type = null,
        ?Status $status = null,
        ?string $type = null,
        ?string $description = null
    ) : static {
        return new static(
            $content_type,
            $status ?? DefaultStatus::_200,
            $type ?? "",
            $description ?? ""
        );
    }
}
