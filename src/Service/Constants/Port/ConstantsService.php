<?php

namespace FluxIliasRestApi\Service\Constants\Port;

use FluxIliasRestApi\Adapter\Constants\ConstantsDto;
use FluxIliasRestApi\Service\Constants\Command\GetConstantsCommand;

class ConstantsService
{

    private function __construct() {

    }


    public static function new() : static {
        return new static();
    }


    public function getConstants() : ConstantsDto
    {
        return GetConstantsCommand::new()
            ->getConstants();
    }
}
