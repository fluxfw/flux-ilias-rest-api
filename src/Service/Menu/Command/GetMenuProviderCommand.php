<?php

namespace FluxIliasRestApi\Service\Menu\Command;

use FluxIliasRestApi\Adapter\Menu\MenuProvider;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ILIAS\DI\Container;
use ilPlugin;

class GetMenuProviderCommand
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
        return MenuProvider::new(
            $this->ilias_dic,
            $ilias_plugin,
            $this->config_form_service,
            $this->proxy_service,
            $user
        );
    }
}
