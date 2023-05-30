<?php

namespace FluxIliasRestApi\Adapter\Cookie;

use FluxIliasRestApi\Adapter\Cookie\Priority\CookiePriority;
use FluxIliasRestApi\Adapter\Cookie\SameSite\CookieSameSite;

class CookieDto
{

    private function __construct(
        public readonly string $name,
        public readonly ?string $value,
        public readonly ?int $expires_in,
        public readonly string $path,
        public readonly string $domain,
        public readonly bool $secure,
        public readonly bool $http_only,
        public readonly ?CookieSameSite $same_site,
        public readonly ?CookiePriority $priority
    ) {

    }


    public static function new(
        string $name,
        ?string $value = null,
        ?int $expires_in = null,
        ?string $path = null,
        ?string $domain = null,
        ?bool $secure = null,
        ?bool $http_only = null,
        ?CookieSameSite $same_site = null,
        ?CookiePriority $priority = null
    ) : static {
        return new static(
            $name,
            $value,
            $expires_in,
            $path ?? "/",
            $domain ?? "",
            $secure ?? true,
            $http_only ?? true,
            $same_site,
            $priority
        );
    }
}
