<?php

namespace FluxIliasRestApi\Adapter\Body;

use FluxIliasRestApi\Adapter\Body\Type\BodyType;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;

class HtmlBodyDto implements BodyDto
{

    private function __construct(
        public readonly string $html
    ) {

    }


    public static function new(
        ?string $html = null
    ) : static {
        return new static(
            $html ?? ""
        );
    }


    public function getType() : BodyType
    {
        return DefaultBodyType::HTML;
    }
}
