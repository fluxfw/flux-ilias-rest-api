<?php

namespace FluxIliasRestApi\Channel\Config\Command;

use FluxIliasRestApi\Channel\Config\ConfigQuery;
use ilSetting;

class GetConfigCommand
{

    use ConfigQuery;

    public static function new() : /*static*/ self
    {
        $command = new static();

        return $command;
    }


    public function getConfig(string $key)/* : mixed*/
    {
        $value = (new ilSetting($this->getConfigSettingsModule()))->get($key, null);
        if ($value === null) {
            return null;
        }

        return json_decode($value);
    }
}
