<?php

namespace FluxIliasRestApi\Channel\Setup\Command;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Channel\Config\Port\ConfigService;
use FluxIliasRestApi\Channel\Cron\Port\CronService;

class UninstallHelperPluginCommand
{

    private ChangeService $change;
    private ConfigService $config;
    private CronService $cron;


    public static function new(ChangeService $change, ConfigService $config, CronService $cron) : /*static*/ self
    {
        $command = new static();

        $command->change = $change;
        $command->config = $config;
        $command->cron = $cron;

        return $command;
    }


    public function uninstallHelperPlugin() : void
    {
        $this->change->dropChangeDatabase();
        $this->config->deleteConfig();
        $this->cron->deleteCronJobs();
    }
}
