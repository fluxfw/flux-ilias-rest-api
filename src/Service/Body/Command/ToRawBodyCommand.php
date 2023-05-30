<?php

namespace FluxIliasRestApi\Service\Body\Command;

use Exception;
use FluxIliasRestApi\Adapter\Body\BodyDto;
use FluxIliasRestApi\Adapter\Body\HtmlBodyDto;
use FluxIliasRestApi\Adapter\Body\JsonBodyDto;
use FluxIliasRestApi\Adapter\Body\RawBodyDto;
use FluxIliasRestApi\Adapter\Body\TextBodyDto;

class ToRawBodyCommand
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function toRawBody(BodyDto $body) : RawBodyDto
    {
        switch (true) {
            case $body instanceof HtmlBodyDto:
                $raw_body = $body->html;
                break;

            case $body instanceof JsonBodyDto:
                $raw_body = json_encode($body->data, JSON_UNESCAPED_SLASHES);

                $error_code = json_last_error();
                if ($error_code !== JSON_ERROR_NONE) {
                    throw new Exception(json_last_error_msg(), $error_code);
                }
                break;

            case $body instanceof TextBodyDto:
                $raw_body = $body->text;
                break;

            default:
                throw new Exception("Content type " . $body->getType()->value . " is not supported");
        }

        return RawBodyDto::new(
            $body->getType()->value,
            $raw_body
        );
    }
}
