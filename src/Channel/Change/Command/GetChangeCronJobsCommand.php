<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\Cron\PurgeChangesCronJob;
use FluxIliasRestApi\Channel\Change\Cron\TransferChangesCronJob;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;

class GetChangeCronJobsCommand
{

    private ChangeService $change;


    public static function new(ChangeService $change) : /*static*/ self
    {
        $command = new static();

        $command->change = $change;

        return $command;
    }


    public function getChangeCronJobs() : array
    {
        return [
            TransferChangesCronJob::new(
                $this->change
            ),
            PurgeChangesCronJob::new(
                $this->change
            )
        ];
    }
}
