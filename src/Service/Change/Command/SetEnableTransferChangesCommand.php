<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\CronConfig\Port\CronConfigService;

class SetEnableTransferChangesCommand
{

    private function __construct(
        private readonly ChangeService $change_service,
        private readonly CronConfigService $cron_config_service
    ) {

    }


    public static function new(
        ChangeService $change_service,
        CronConfigService $cron_config_service
    ) : static {
        return new static(
            $change_service,
            $cron_config_service
        );
    }


    public function setEnableTransferChanges(bool $enable_transfer_changes) : void
    {
        $this->cron_config_service->setCronJobEnabled(
            $this->change_service->getTransferChangesCronJob(),
            $enable_transfer_changes
        );
    }
}
