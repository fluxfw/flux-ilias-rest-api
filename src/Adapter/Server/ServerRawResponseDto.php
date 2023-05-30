<?php

namespace FluxIliasRestApi\Adapter\Server;

use FluxIliasRestApi\Adapter\Cookie\CookieDto;
use FluxIliasRestApi\Adapter\Header\HeaderKey;
use FluxIliasRestApi\Adapter\Status\DefaultStatus;
use FluxIliasRestApi\Adapter\Status\Status;

class ServerRawResponseDto
{

    /**
     * @param string[]    $headers
     * @param CookieDto[] $cookies
     */
    private function __construct(
        public readonly ?string $body,
        public readonly Status $status,
        public readonly array $headers,
        public readonly array $cookies,
        public readonly ?string $sendfile
    ) {

    }


    /**
     * @param string[]|null    $headers
     * @param CookieDto[]|null $cookies
     */
    public static function new(
        ?string $body = null,
        ?Status $status = null,
        ?array $headers = null,
        ?array $cookies = null,
        ?string $sendfile = null
    ) : static {
        $headers ??= [];

        return new static(
            $body,
            $status ?? DefaultStatus::_200,
            array_combine(array_map("strtolower", array_keys($headers)), $headers),
            $cookies ?? [],
            $sendfile
        );
    }


    public function getCookie(string $name) : ?CookieDto
    {
        return $this->cookies[$name] ?? null;
    }


    public function getHeader(HeaderKey $key) : ?string
    {
        return $this->headers[strtolower($key->value)] ?? null;
    }
}
