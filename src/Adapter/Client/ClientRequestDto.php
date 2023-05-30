<?php

namespace FluxIliasRestApi\Adapter\Client;

use FluxIliasRestApi\Adapter\Body\BodyDto;
use FluxIliasRestApi\Adapter\Header\HeaderKey;
use FluxIliasRestApi\Adapter\Method\DefaultMethod;
use FluxIliasRestApi\Adapter\Method\Method;

class ClientRequestDto
{

    /**
     * @param string[] $headers
     */
    private function __construct(
        public readonly string $url,
        public readonly Method $method,
        public readonly array $query_params,
        public readonly ?string $raw_body,
        public readonly array $headers,
        public readonly ?BodyDto $parsed_body,
        public readonly array $params,
        public readonly ?string $file,
        public readonly bool $response,
        public readonly bool $fail_on_status_400_or_higher,
        public readonly bool $follow_redirect,
        public readonly bool $trust_self_signed_certificate,
        public readonly bool $parse_response_body
    ) {

    }


    /**
     * @param string[]|null $headers
     */
    public static function new(
        string $url,
        ?Method $method = null,
        ?array $query_params = null,
        ?string $raw_body = null,
        ?array $headers = null,
        ?BodyDto $parsed_body = null,
        ?array $params = null,
        ?string $file = null,
        ?bool $response = null,
        ?bool $fail_on_status_400_or_higher = null,
        ?bool $follow_redirect = null,
        ?bool $trust_self_signed_certificate = null,
        ?bool $parse_response_body = null
    ) : static {
        $headers ??= [];

        return new static(
            $url,
            $method ?? DefaultMethod::GET,
            $query_params ?? [],
            $raw_body,
            array_combine(array_map("strtolower", array_keys($headers)), $headers),
            $parsed_body,
            $params ?? [],
            $file,
            $response ?? true,
            $fail_on_status_400_or_higher ?? true,
            $follow_redirect ?? true,
            $trust_self_signed_certificate ?? false,
            $parse_response_body ?? false
        );
    }


    public function getHeader(HeaderKey $key) : ?string
    {
        return $this->headers[strtolower($key->value)] ?? null;
    }


    public function getParam(string $name) : mixed
    {
        return $this->params[$name] ?? null;
    }


    public function getQueryParam(string $name) : mixed
    {
        return $this->query_params[$name] ?? null;
    }
}
