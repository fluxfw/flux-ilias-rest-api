<?php

namespace FluxIliasRestApi\Adapter\Authorization\ParseHttpBasic;

use SensitiveParameter;

class HttpBasicAuthorizationDto
{

    private function __construct(
        public readonly string $user,
        public readonly string $password
    ) {

    }


    public static function new(
        string $user,
        #[SensitiveParameter] string $password
    ) : static {
        return new static(
            $user,
            $password
        );
    }
}
