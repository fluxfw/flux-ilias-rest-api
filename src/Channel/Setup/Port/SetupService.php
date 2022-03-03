<?php

namespace FluxIliasRestApi\Channel\Setup\Port;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Channel\Config\Port\ConfigService;
use FluxIliasRestApi\Channel\Cron\Port\CronService;
use FluxIliasRestApi\Channel\Setup\Command\InstallHelperPluginCommand;
use FluxIliasRestApi\Channel\Setup\Command\UninstallHelperPluginCommand;

class SetupService
{

    private ChangeService $change;
    private ConfigService $config;
    private CronService $cron;


    public static function new(ChangeService $change, ConfigService $config, CronService $cron) : /*static*/ self
    {
        $service = new static();

        $service->change = $change;
        $service->config = $config;
        $service->cron = $cron;

        return $service;
    }


    public function installHelperPlugin() : void
    {
        InstallHelperPluginCommand::new(
            $this->change
        )
            ->installHelperPlugin();
    }


    public function uninstallHelperPlugin() : void
    {
        UninstallHelperPluginCommand::new(
            $this->change,
            $this->config,
            $this->cron
        )
            ->uninstallHelperPlugin();
    }
}
