<?php

namespace FluxIliasRestApi\Service\Setup\Command;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\Config\Port\ConfigService;
use FluxIliasRestApi\Service\Cron\Port\CronService;
use FluxIliasRestApi\Service\ObjectConfig\Port\ObjectConfigService;

class UninstallHelperPluginCommand
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


    public function uninstallHelperPlugin() : void
    {
        $this->change_service->dropChangeDatabase();
        $this->config_service->deleteConfig();
        $this->cron_service->deleteCronJobs();
        $this->object_config_service->deleteObjectConfigs();
    }
}
