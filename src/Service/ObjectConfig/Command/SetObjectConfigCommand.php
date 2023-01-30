<?php

namespace FluxIliasRestApi\Service\ObjectConfig\Command;

use FluxIliasRestApi\Service\Config\ConfigQuery;
use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigKey;
use FluxIliasRestApi\Service\ObjectConfig\ObjectConfigQuery;
use ilContainer;

class SetObjectConfigCommand
{

    use ConfigQuery;
    use ObjectConfigQuery;

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function setObjectConfig(int $id, ObjectConfigKey $key, mixed $value) : void
    {
        ilContainer::_writeContainerSetting($id, $this->getObjectConfigContainerSettingsPrefix() . $key->value, $this->getValueAsJson(
            $value
        ));
    }
}
