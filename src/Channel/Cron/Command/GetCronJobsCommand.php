<?php

namespace FluxIliasRestApi\Channel\Cron\Command;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;

class GetCronJobsCommand
{

    private ChangeService $change;


    public static function new(ChangeService $change) : /*static*/ self
    {
        $command = new static();

        $command->change = $change;

        return $command;
    }


    public function getCronJobs() : array
    {
        return $this->change->getChangeCronJobs();
    }
}
