<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetTransferChangesUserCommand
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


    public function setTransferChangesUser(?string $transfer_changes_user) : void
    {
        $this->config_service->setConfig(
            ConfigKey::TRANSFER_CHANGES_USER,
            $transfer_changes_user
        );
    }
}
