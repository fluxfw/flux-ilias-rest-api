<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Adapter\Cron\Change\TransferChangesCronJob;
use FluxIliasRestApi\Service\Change\Port\ChangeService;

class GetTransferChangesCronJobCommand
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


    public function getTransferChangesCronJob() : TransferChangesCronJob
    {
        return TransferChangesCronJob::new(
            $this->change_service
        );
    }
}
