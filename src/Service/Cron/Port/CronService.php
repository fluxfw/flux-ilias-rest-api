<?php

namespace FluxIliasRestApi\Service\Cron\Port;

use FluxIliasRestApi\Service\Change\Port\ChangeService;
use FluxIliasRestApi\Service\Cron\Command\DeleteCronJobsCommand;
use FluxIliasRestApi\Service\Cron\Command\GetCronJobCommand;
use FluxIliasRestApi\Service\Cron\Command\GetCronJobsCommand;
use ilCronJob;
use ilDBInterface;

class CronService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : static {
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


    /**
     * @return ilCronJob[]
     */
    public function getCronJobs() : array
    {
        return GetCronJobsCommand::new(
            $this->change_service
        )
            ->getCronJobs();
    }
}
