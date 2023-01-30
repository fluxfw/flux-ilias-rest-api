<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Adapter\Cron\Change\PurgeChangesCronJob;
use FluxIliasRestApi\Service\Change\Port\ChangeService;

class GetPurgeChangesCronJobCommand
{

    private function __construct(
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ChangeService $change_service
    ) : static {
        return new static(
            $change_service
        );
    }


    public function getPurgeChangesCronJob() : PurgeChangesCronJob
    {
        return PurgeChangesCronJob::new(
            $this->change_service
        );
    }
}
