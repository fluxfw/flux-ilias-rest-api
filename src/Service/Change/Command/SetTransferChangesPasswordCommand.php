<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetTransferChangesPasswordCommand
{

    private function __construct(
        private readonly ConfigService $config_service
    ) {

    }


    public static function new(
        ConfigService $config_service
    ) : static {
        return new static(
            $config_service
        );
    }


    public function setTransferChangesPassword(?string $transfer_changes_password) : void
    {
        $this->config_service->setConfig(
            ConfigKey::TRANSFER_CHANGES_PASSWORD,
            $transfer_changes_password
        );
    }
}
