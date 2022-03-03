<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class LastTransferredChangeTimeCommand
{

    private const CONFIG_KEY = "last_transferred_change_time";
    private ConfigService $config;


    public static function new(ConfigService $config) : /*static*/ self
    {
        $command = new static();

        $command->config = $config;

        return $command;
    }


    public function getLastTransferredChangeTime() : ?float
    {
        return $this->config->getConfig(
            static::CONFIG_KEY
        );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        $this->config->setConfig(
            static::CONFIG_KEY,
            $last_transferred_change_time
        );
    }
}
