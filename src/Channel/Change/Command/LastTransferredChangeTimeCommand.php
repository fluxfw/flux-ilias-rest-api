<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class LastTransferredChangeTimeCommand
{

    private const CONFIG_KEY = "last_transferred_change_time";
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


    public function getLastTransferredChangeTime() : ?float
    {
        return $this->config_service->getConfig(
            static::CONFIG_KEY
        );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        $this->config_service->setConfig(
            static::CONFIG_KEY,
            $last_transferred_change_time
        );
    }
}
