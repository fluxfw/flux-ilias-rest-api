<?php

namespace FluxIliasRestApi\Service\ConfigForm\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Constants\Port\ConstantsService;

class HasAccessToConfigFormCommand
{

    private function __construct(
        private readonly ConstantsService $constants_service
    )
    {

    }


    public static function new(
        ConstantsService $constants_service
    ) : static
    {
        return new static(
            $constants_service
        );
    }


    public function hasAccessToConfigForm(?UserDto $user) : bool
    {
        return $user !== null && $user->id === $this->constants_service->getConstants()->root_user_id;
    }
}
