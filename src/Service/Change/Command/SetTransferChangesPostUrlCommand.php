<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\Port\ConfigService;

class SetTransferChangesPostUrlCommand
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


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        $this->config_service->setConfig(
            ConfigKey::TRANSFER_CHANGES_POST_URL,
            $transfer_changes_post_url
        );
    }
}
