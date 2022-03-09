<?php

namespace FluxIliasRestApi\Channel\Setup\Command;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Channel\Config\Port\ConfigService;
use FluxIliasRestApi\Channel\Cron\Port\CronService;

class UninstallHelperPluginCommand
{

    private ChangeService $change_service;
    private ConfigService $config_service;
    private CronService $cron_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service,
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ CronService $cron_service
    ) {
        $this->change_service = $change_service;
        $this->config_service = $config_service;
        $this->cron_service = $cron_service;
    }


    public static function new(
        ChangeService $change_service,
        ConfigService $config_service,
        CronService $cron_service
    ) : /*static*/ self
    {
        return new static(
            $change_service,
            $config_service,
            $cron_service
        );
    }


    public function uninstallHelperPlugin() : void
    {
        $this->change_service->dropChangeDatabase();
        $this->config_service->deleteConfig();
        $this->cron_service->deleteCronJobs();
    }
}
