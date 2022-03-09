<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\Cron\PurgeChangesCronJob;
use FluxIliasRestApi\Channel\Change\Cron\TransferChangesCronJob;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;

class GetChangeCronJobsCommand
{

    private ChangeService $change_service;


    private function __construct(
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->change_service = $change_service;
    }


    public static function new(
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $change_service
        );
    }


    public function getChangeCronJobs() : array
    {
        return [
            TransferChangesCronJob::new(
                $this->change_service
            ),
            PurgeChangesCronJob::new(
                $this->change_service
            )
        ];
    }
}
