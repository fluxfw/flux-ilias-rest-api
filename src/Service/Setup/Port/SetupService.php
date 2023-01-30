<?php

namespace FluxIliasRestApi\Service\Setup\Port;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\Config\Port\ConfigService;
use FluxIliasRestApi\Service\Cron\Port\CronService;
use FluxIliasRestApi\Service\ObjectConfig\Port\ObjectConfigService;
use FluxIliasRestApi\Service\Setup\Command\InstallHelperPluginCommand;
use FluxIliasRestApi\Service\Setup\Command\UninstallHelperPluginCommand;

class SetupService
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly ConfigService $config_service,
        private readonly CronService $cron_service,
        private readonly ObjectConfigService $object_config_service
    ) {

    }


    public static function new(
        ChangeService $change_service,
        ConfigService $config_service,
        CronService $cron_service,
        ObjectConfigService $object_config_service
    ) : static {
        return new static(
            $change_service,
            $config_service,
            $cron_service,
            $object_config_service
        );
    }


    public function installHelperPlugin() : void
    {
        InstallHelperPluginCommand::new(
            $this->change_service
        )
            ->installHelperPlugin();
    }


    public function uninstallHelperPlugin() : void
    {
        UninstallHelperPluginCommand::new(
            $this->change_service,
            $this->config_service,
            $this->cron_service,
            $this->object_config_service
        )
            ->uninstallHelperPlugin();
    }
}
