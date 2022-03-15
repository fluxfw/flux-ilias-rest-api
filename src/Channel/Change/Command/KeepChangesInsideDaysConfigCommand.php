<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class KeepChangesInsideDaysConfigCommand
{

    private const CONFIG_KEY = "keep_changes_inside_days";
    private const DEFAULT_VALUE = 7;
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


    public function getKeepChangesInsideDays() : int
    {
        return intval($this->config_service->getConfig(
                static::CONFIG_KEY
            ) ?? static::DEFAULT_VALUE);
    }


    public function setKeepChangesInsideDays(int $keep_changes_inside_days) : void
    {
        $this->config_service->setConfig(
            static::CONFIG_KEY,
            $keep_changes_inside_days
        );
    }
}
