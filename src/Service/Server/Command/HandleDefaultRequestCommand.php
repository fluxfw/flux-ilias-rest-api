<?php

namespace FluxIliasRestApi\Service\Server\Command;

use FluxIliasRestApi\Service\Body\Port\BodyService;
use FluxIliasRestApi\Service\Server\Port\ServerService;

class HandleDefaultRequestCommand
{

    private function __construct(
        private readonly ServerService $server_service,
        private readonly BodyService $body_service
    ) {

    }


    public static function new(
        ServerService $server_service,
        BodyService $body_service
    ) : static {
        return new static(
            $server_service,
            $body_service
        );
    }


    public function handleDefaultRequest() : void
    {
        $this->body_service->handleDefaultResponse(
            $this->server_service->handleRequest(
                $request = $this->body_service->getDefaultRequest(),
                true
            )
        );
    }
}
