<?php

namespace FluxIliasRestApi\Service\Body\Port;

use FluxIliasRestApi\Adapter\Body\BodyDto;
use FluxIliasRestApi\Adapter\Body\RawBodyDto;
use FluxIliasRestApi\Adapter\Server\ServerRawRequestDto;
use FluxIliasRestApi\Adapter\Server\ServerRawResponseDto;
use FluxIliasRestApi\Service\Body\Command\GetDefaultRequestCommand;
use FluxIliasRestApi\Service\Body\Command\HandleDefaultResponseCommand;
use FluxIliasRestApi\Service\Body\Command\ParseBodyCommand;
use FluxIliasRestApi\Service\Body\Command\ToRawBodyCommand;

class BodyService
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getDefaultRequest() : ServerRawRequestDto
    {
        return GetDefaultRequestCommand::new()
            ->getDefaultRequest();
    }


    public function handleDefaultResponse(ServerRawResponseDto $response) : void
    {
        HandleDefaultResponseCommand::new()
            ->handleDefaultResponse(
                $response
            );
    }


    public function parseBody(RawBodyDto $body, ?array $post = null, ?array $files = null) : ?BodyDto
    {
        return ParseBodyCommand::new()
            ->parseBody(
                $body,
                $post,
                $files
            );
    }


    public function toRawBody(BodyDto $body) : RawBodyDto
    {
        return ToRawBodyCommand::new()
            ->toRawBody(
                $body
            );
    }
}
