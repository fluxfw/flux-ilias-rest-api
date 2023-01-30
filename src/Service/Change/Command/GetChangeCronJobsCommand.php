<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use ilCronJob;

class GetChangeCronJobsCommand
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


    /**
     * @return ilCronJob[]
     */
    public function getChangeCronJobs() : array
    {
        return [
            $this->change_service->getTransferChangesCronJob(),
            $this->change_service->getPurgeChangesCronJob()
        ];
    }
}
