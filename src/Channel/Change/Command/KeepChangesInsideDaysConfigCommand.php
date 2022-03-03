<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Config\Port\ConfigService;

class KeepChangesInsideDaysConfigCommand
{

    private const CONFIG_KEY = "keep_changes_inside_days";
    private const DEFAULT_VALUE = 7;
    private ConfigService $config;


    public static function new(ConfigService $config) : /*static*/ self
    {
        $command = new static();

        $command->config = $config;

        return $command;
    }


    public function getKeepChangesInsideDays() : int
    {
        return intval($this->config->getConfig(
                static::CONFIG_KEY
            ) ?? static::DEFAULT_VALUE);
    }


    public function setKeepChangesInsideDays(int $keep_changes_inside_days) : void
    {
        $this->config->setConfig(
            static::CONFIG_KEY,
            $keep_changes_inside_days
        );
    }
}
