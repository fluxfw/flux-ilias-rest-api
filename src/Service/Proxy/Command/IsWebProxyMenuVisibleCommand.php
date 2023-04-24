<?php

namespace FluxIliasRestApi\Service\Proxy\Command;

use FluxIliasRestApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Constants\Port\ConstantsService;
use FluxIliasRestApi\Service\UserRole\Port\UserRoleService;

class IsWebProxyMenuVisibleCommand
{

    private function __construct(
        private readonly ConstantsService $constants_service,
        private readonly UserRoleService $user_role_service
    )
    {

    }


    public static function new(
        ConstantsService $constants_service,
        UserRoleService $user_role_service
    ) : static
    {
        return new static(
            $constants_service,
            $user_role_service
        );
    }


    public function isWebProxyMenuVisible(WebProxyMapDto $web_proxy_map, ?UserDto $user) : bool
    {
        if (!$web_proxy_map->visible_public_menu_item && $user === null) {
            return false;
        }

        if ($web_proxy_map->visible_administrator_role_only_menu_item && ($user === null || empty($this->user_role_service->getUserRoles($user->id, null, $this->constants_service->getConstants()->administrator_role_id)))) {
            return false;
        }

        return true;
    }
}
