<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class TransferChangesPostUrlConfigCommand
{

    private const CONFIG_KEY = "transfer_changes_post_url";
    private ConfigService $config;


    public static function new(ConfigService $config) : /*static*/ self
    {
        $command = new static();

        $command->config = $config;

        return $command;
    }


    public function getTransferChangesPostUrl() : string
    {
        return strval($this->config->getConfig(
            static::CONFIG_KEY
        ));
    }


    public function setTransferChangesPostUrl(string $transfer_changes_post_url) : void
    {
        $this->config->setConfig(
            static::CONFIG_KEY,
            $transfer_changes_post_url
        );
    }
}
