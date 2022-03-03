<?php

namespace FluxIliasRestApi\Channel\Config\Command;

use FluxIliasRestApi\Channel\Config\ConfigQuery;
use ilSetting;

class DeleteConfigCommand
{

    use ConfigQuery;

    public static function new() : /*static*/ self
    {
        $command = new static();

        return $command;
    }


    public function deleteConfig() : void
    {
        (new ilSetting($this->getConfigSettingsModule()))->deleteAll();
    }
}
