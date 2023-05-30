<?php

namespace FluxIliasRestApi\Adapter\Body;

use FluxIliasRestApi\Adapter\Body\Type\BodyType;
use FluxIliasRestApi\Adapter\Body\Type\DefaultBodyType;

class JsonBodyDto implements BodyDto
{

    private function __construct(
        public readonly mixed $data
    ) {

    }


    public static function new(
        mixed $data
    ) : static {
        return new static(
            $data
        );
    }


    public function getType() : BodyType
    {
        return DefaultBodyType::JSON;
    }
}
