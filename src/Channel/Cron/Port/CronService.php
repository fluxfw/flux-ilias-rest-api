<?php

namespace FluxIliasRestApi\Channel\Cron\Port;

use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use FluxIliasRestApi\Channel\Cron\Command\DeleteCronJobsCommand;
use FluxIliasRestApi\Channel\Cron\Command\GetCronJobCommand;
use FluxIliasRestApi\Channel\Cron\Command\GetCronJobsCommand;
use ilCronJob;
use ilDBInterface;

class CronService
{

    private ChangeService $change;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, ChangeService $change) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->change = $change;

        return $service;
    }


    public function deleteCronJobs() : void
    {
        DeleteCronJobsCommand::new(
            $this->database
        )
            ->deleteCronJobs();
    }


    public function getCronJob(string $id) : ?ilCronJob
    {
        return GetCronJobCommand::new(
            $this->getCronJobs()
        )
            ->getCronJob(
                $id
            );
    }


    public function getCronJobs() : array
    {
        return GetCronJobsCommand::new(
            $this->change
        )
            ->getCronJobs();
    }
}
