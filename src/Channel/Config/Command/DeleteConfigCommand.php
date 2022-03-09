<?php

namespace FluxIliasRestApi\Channel\Config\Command;

use FluxIliasRestApi\Channel\Config\ConfigQuery;
use ilSetting;

class DeleteConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function deleteConfig() : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->deleteAll();
    }
}
