<?php

namespace FluxIliasRestApi\Channel\Config\Command;

use FluxIliasRestApi\Channel\Config\ConfigQuery;
use ilSetting;

class GetConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
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
