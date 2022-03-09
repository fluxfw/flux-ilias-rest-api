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

    private ChangeService $change_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->change_service = $change_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $change_service
        );
    }


    public function deleteCronJobs() : void
    {
        DeleteCronJobsCommand::new(
            $this->ilias_database
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
            $this->change_service
        )
            ->getCronJobs();
    }
}
