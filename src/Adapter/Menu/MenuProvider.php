<?php

namespace FluxIliasRestApi\Adapter\Menu;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Proxy\Port\ProxyService;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticMainMenuPluginProvider;
use ilPlugin;

class MenuProvider extends AbstractStaticMainMenuPluginProvider
{

    private ConfigFormService $config_form_service;
    private ProxyService $proxy_service;
    private ?UserDto $user;


    public static function new(
        Container $ilias_dic,
        ilPlugin $ilias_plugin,
        ConfigFormService $config_form_service,
        ProxyService $proxy_service,
        ?UserDto $user
    ) : static {
        $provider = new static(
            $ilias_dic,
            $ilias_plugin
        );

        $provider->config_form_service = $config_form_service;
        $provider->proxy_service = $proxy_service;
        $provider->user = $user;

        return $provider;
    }


    public function getStaticSubItems() : array
    {
        return [];
    }


    public function getStaticTopItems() : array
    {
        return array_merge([
            $this->config_form_service->getConfigFormMenuItem(
                $this->if,
                $this->user
            )
        ], $this->proxy_service->getWebProxyMenuItems(
            $this->if,
            $this->user
        ));
    }
}
