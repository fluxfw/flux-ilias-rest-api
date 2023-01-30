<?php

namespace FluxIliasRestApi\Service\Menu\Port;

use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\Menu\MenuProvider;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Menu\Command\GetMenuProviderCommand;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ILIAS\DI\Container;
use ilPlugin;

class MenuService
{

    private function __construct(
        private readonly Container $ilias_dic,
        private readonly ConfigFormService $config_form_service,
        private readonly ProxyService $proxy_service
    ) {

    }


    public static function new(
        Container $ilias_dic,
        ConfigFormService $config_form_service,
        ProxyService $proxy_service
    ) : static {
        return new static(
            $ilias_dic,
            $config_form_service,
            $proxy_service
        );
    }


    public function getMenuProvider(ilPlugin $ilias_plugin, ?UserDto $user) : MenuProvider
    {
        return GetMenuProviderCommand::new(
            $this->ilias_dic,
            $this->config_form_service,
            $this->proxy_service
        )
            ->getMenuProvider(
                $ilias_plugin,
                $user
            );
    }
}
