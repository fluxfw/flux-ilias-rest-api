<?php

namespace FluxIliasRestApi\Service\Constants\Command;

use FluxIliasRestApi\Adapter\Constants\ConstantsDto;
use ilObjOrgUnit;

class GetConstantsCommand
{

    private function __construct() {

    }


    public static function new() : static {
        return new static();
    }


    public function getConstants() : ConstantsDto
    {
        return ConstantsDto::new(
            ROOT_FOLDER_ID,
            SYSTEM_FOLDER_ID,
            RECOVERY_FOLDER_ID,
            ilObjOrgUnit::getRootOrgId(),
            ilObjOrgUnit::getRootOrgRefId(),
            USER_FOLDER_ID,
            SYSTEM_USER_ID,
            ANONYMOUS_USER_ID,
            ROLE_FOLDER_ID,
            SYSTEM_ROLE_ID,
            ANONYMOUS_ROLE_ID,
            5,
            4
        );
    }
}
