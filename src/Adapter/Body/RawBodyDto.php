<?php

namespace FluxIliasRestApi\Adapter\Body;

class RawBodyDto
{

    private function __construct(
        public readonly string $type,
        public readonly string $body
    ) {

    }


    public static function new(
        ?string $type = null,
        ?string $body = null
    ) : static {
        return new static(
            $type ?? "",
            $body ?? ""
        );
    }
}
