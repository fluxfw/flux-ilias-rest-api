<?php

namespace FluxIliasRestApi\Service\Client\Port;

use FluxIliasRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasRestApi\Adapter\Client\ClientResponseDto;
use FluxIliasRestApi\Service\Body\Port\BodyService;
use FluxIliasRestApi\Service\Client\Command\MakeRequestCommand;

class ClientService
{

    private function __construct(
        private readonly BodyService $body_service
    ) {

    }


    public static function new(
        BodyService $body_service
    ) : static {
        return new static(
            $body_service
        );
    }


    public function makeRequest(ClientRequestDto $request) : ?ClientResponseDto
    {
        return MakeRequestCommand::new(
            $this->body_service
        )
            ->makeRequest(
                $request
            );
    }
}
