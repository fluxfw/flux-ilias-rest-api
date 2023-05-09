<?php

namespace FluxIliasRestApi\Service\Constants\Command;

use FluxIliasRestApi\Adapter\Constants\ConstantsDto;
use ilObjOrgUnit;
use ilObjUser;

class GetConstantsCommand
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
        return ConstantsDto::new(
            ROOT_FOLDER_ID,
            SYSTEM_FOLDER_ID,
            RECOVERY_FOLDER_ID,
            ilObjOrgUnit::getRootOrgId(),
            ilObjOrgUnit::getRootOrgRefId(),
            USER_FOLDER_ID,
            SYSTEM_USER_ID,
            ANONYMOUS_USER_ID,
            $this->ilias_user->getId(),
            ROLE_FOLDER_ID,
            SYSTEM_ROLE_ID,
            ANONYMOUS_ROLE_ID,
            5,
            4
        );
    }
}
