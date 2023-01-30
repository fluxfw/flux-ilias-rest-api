<?php

namespace FluxIliasRestApi\Service\Config\Port;

use FluxIliasRestApi\Service\Config\Command\DeleteConfigCommand;
use FluxIliasRestApi\Service\Config\Command\GetConfigCommand;
use FluxIliasRestApi\Service\Config\Command\SetConfigCommand;
use FluxIliasRestApi\Service\Config\ConfigKey;

class ConfigService
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function deleteConfig() : void
    {
        DeleteConfigCommand::new()
            ->deleteConfig();
    }


    public function getConfig(ConfigKey $key) : mixed
    {
        return GetConfigCommand::new()
            ->getConfig(
                $key
            );
    }


    public function setConfig(ConfigKey $key, mixed $value) : void
    {
        SetConfigCommand::new()
            ->setConfig(
                $key,
                $value
            );
    }
}
