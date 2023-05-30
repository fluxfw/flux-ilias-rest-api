<?php

namespace FluxIliasRestApi\Service\Proxy\Port;

use FluxIliasRestApi\Adapter\Proxy\WebProxyMapDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\ConfigForm\Port\ConfigFormService;
use FluxIliasRestApi\Service\Constants\Port\ConstantsService;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\Proxy\Command\GetWebProxyCommand;
use FluxIliasRestApi\Service\Proxy\Command\GetWebProxyMenuItemsCommand;
use FluxIliasRestApi\Service\Proxy\Command\HandleIliasGotoCommand;
use FluxIliasRestApi\Service\Proxy\Command\HandleIliasRedirectCommand;
use FluxIliasRestApi\Service\Proxy\Command\IsWebProxyMenuVisibleCommand;
use FluxIliasRestApi\Service\ProxyConfig\Port\ProxyConfigService;
use FluxIliasRestApi\Service\Rest\Port\RestService;
use FluxIliasRestApi\Service\UserRole\Port\UserRoleService;
use ilGlobalTemplateInterface;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ilLocatorGUI;

class ProxyService
{

    private function __construct(
        private readonly RestService $rest_service,
        private readonly ConfigFormService $config_form_service,
        private readonly ProxyConfigService $proxy_config_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ConstantsService $constants_service,
        private readonly UserRoleService $user_role_service,
        private readonly Container $ilias_dic
    ) {

    }


    public static function new(
        RestService $rest_service,
        ConfigFormService $config_form_service,
        ProxyConfigService $proxy_config_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ConstantsService $constants_service,
        UserRoleService $user_role_service,
        Container $ilias_dic
    ) : static {
        return new static(
            $rest_service,
            $config_form_service,
            $proxy_config_service,
            $flux_ilias_rest_object_service,
            $constants_service,
            $user_role_service,
            $ilias_dic
        );
    }


    public function getWebProxy(
        ilGlobalTemplateInterface $ilias_global_template,
        string $url,
        ?string $page_title = null,
        ?string $short_title = null,
        ?string $view_title = null,
        ?string $route = null,
        ?array $query_params = null,
        ?string $original_route = null,
        ?string $permanent_link = null
    ) : string {
        return GetWebProxyCommand::new(
            $this->proxy_config_service,
            $ilias_global_template
        )
            ->getWebProxy(
                $url,
                $page_title,
                $short_title,
                $view_title,
                $route,
                $query_params,
                $original_route,
                $permanent_link
            );
    }


    public function getWebProxyMenuItems(IdentificationProviderInterface $if, ?UserDto $user) : array
    {
        return GetWebProxyMenuItemsCommand::new(
            $this->proxy_config_service,
            $this,
            $this->ilias_dic
        )
            ->getWebProxyMenuItems(
                $if,
                $user
            );
    }


    public function handleIliasGoto(ilGlobalTemplateInterface $ilias_global_template, ilLocatorGUI $ilias_locator, ?UserDto $user) : void
    {
        HandleIliasGotoCommand::new(
            $this,
            $this->proxy_config_service,
            $this->rest_service,
            $this->config_form_service,
            $this->flux_ilias_rest_object_service,
            $ilias_global_template,
            $ilias_locator
        )
            ->handleIliasGoto(
                $user
            );
    }


    public function handleIliasRedirect(string $url) : ?string
    {
        return HandleIliasRedirectCommand::new(
            $this->rest_service
        )
            ->handleIliasRedirect(
                $url
            );
    }


    public function isWebProxyMenuVisible(WebProxyMapDto $web_proxy_map, ?UserDto $user) : bool
    {
        return IsWebProxyMenuVisibleCommand::new(
            $this->constants_service,
            $this->user_role_service
        )
            ->isWebProxyMenuVisible(
                $web_proxy_map,
                $user
            );
    }
}
