<?php

namespace FluxIliasRestApi\Service\Constants\Port;

use FluxIliasRestApi\Adapter\Constants\ConstantsDto;
use FluxIliasRestApi\Service\Constants\Command\GetConstantsCommand;
use ilObjUser;

class ConstantsService
{

    private function __construct(
        private readonly ilObjUser $ilias_user
    ) {

    }


    public static function new(
        ilObjUser $ilias_user
    ) : static {
        return new static(
            $ilias_user
        );
    }


    public function getConstants() : ConstantsDto
    {
        return GetConstantsCommand::new(
            $this->ilias_user
        )
            ->getConstants();
    }
}
