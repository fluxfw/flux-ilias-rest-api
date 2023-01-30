<?php

namespace FluxIliasRestApi\Service\Config\Command;

use FluxIliasRestApi\Service\Config\ConfigQuery;
use ilSetting;

class DeleteConfigCommand
{

    use ConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function deleteConfig() : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->deleteAll();
    }
}
