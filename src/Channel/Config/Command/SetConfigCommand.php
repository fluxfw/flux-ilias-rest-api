<?php

namespace FluxIliasRestApi\Channel\Config\Command;

use FluxIliasRestApi\Channel\Config\ConfigQuery;
use ilSetting;

class SetConfigCommand
{

    use ConfigQuery;

    public static function new() : /*static*/ self
    {
        $command = new static();

        return $command;
    }


    public function setConfig(string $key, /*mixed*/ $value) : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->set($key, json_encode($value, JSON_UNESCAPED_SLASHES));
    }
}
