<?php

namespace FluxIliasRestApi\Service\ConfigForm\Port;

use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\ConfigForm\Command\GetConfigFormMenuItemsCommand;
use FluxIliasRestApi\Service\ConfigForm\Command\GetConfigFormValuesCommand;
use FluxIliasRestApi\Service\ConfigForm\Command\HasAccessToConfigFormCommand;
use FluxIliasRestApi\Service\ConfigForm\Command\StoreConfigFormValuesCommand;
use FluxIliasRestApi\Service\FluxIliasRestObject\Port\FluxIliasRestObjectService;
use FluxIliasRestApi\Service\ProxyConfig\Port\ProxyConfigService;
use FluxIliasRestApi\Service\RestConfig\Port\RestConfigService;
use ILIAS\DI\Container;
use ILIAS\GlobalScreen\Identification\IdentificationProviderInterface;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\Item\Link as MainMenuLink;

class ConfigFormService
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly FluxIliasRestObjectService $flux_ilias_rest_object_service,
        private readonly ProxyConfigService $proxy_config_service,
        private readonly RestConfigService $rest_config_service,
        private readonly Container $ilias_dic
    ) {

    }


    public static function new(
        ChangeService $change_service,
        FluxIliasRestObjectService $flux_ilias_rest_object_service,
        ProxyConfigService $proxy_config_service,
        RestConfigService $rest_config_service,
        Container $ilias_dic
    ) : static {
        return new static(
            $change_service,
            $flux_ilias_rest_object_service,
            $proxy_config_service,
            $rest_config_service,
            $ilias_dic
        );
    }


    public function getConfigFormMenuItem(IdentificationProviderInterface $if, ?UserDto $user) : MainMenuLink
    {
        return GetConfigFormMenuItemsCommand::new(
            $this,
            $this->ilias_dic
        )
            ->getConfigFormMenuItem(
                $if,
                $user
            );
    }


    public function getConfigFormValues() : object
    {
        return GetConfigFormValuesCommand::new(
            $this->change_service,
            $this->flux_ilias_rest_object_service,
            $this->proxy_config_service,
            $this->rest_config_service
        )
            ->getConfigFormValues();
    }


    public function hasAccessToConfigForm(?UserDto $user) : bool
    {
        return HasAccessToConfigFormCommand::new()
            ->hasAccessToConfigForm(
                $user
            );
    }


    public function storeConfigFormValues(object $values) : bool
    {
        return StoreConfigFormValuesCommand::new(
            $this->change_service,
            $this->flux_ilias_rest_object_service,
            $this->proxy_config_service,
            $this->rest_config_service
        )
            ->storeConfigFormValues(
                $values
            );
    }
}
