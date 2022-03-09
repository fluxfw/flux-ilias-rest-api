<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class TransferChangesPostUrlConfigCommand
{

    private const CONFIG_KEY = "transfer_changes_post_url";
    private ConfigService $config_service;


    private function __construct(
        /*private readonly*/ ConfigService $config_service
    ) {
        $this->config_service = $config_service;
    }


    public static function new(
        ConfigService $config_service
    ) : /*static*/ self
    {
        return new static(
            $config_service
        );
    }


    public function getTransferChangesPostUrl() : string
    {
        return strval($this->config_service->getConfig(
            static::CONFIG_KEY
        ));
    }


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        $this->config_service->setConfig(
            static::CONFIG_KEY,
            $transfer_changes_post_url
        );
    }
}
