<?php

namespace FluxIliasRestApi\Service\Config\Command;

use FluxIliasRestApi\Service\Config\ConfigKey;
use FluxIliasRestApi\Service\Config\ConfigQuery;
use ilSetting;

class GetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function getConfig(ConfigKey $key) : mixed
    {
        return $this->getValueFromJson(
            (new ilSetting($this->getConfigSettingsModule()))->get($key->value, null)
        );
    }
}
