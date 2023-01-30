<?php

namespace FluxIliasRestApi\Service\Cron\Command;

use FluxIliasRestApi\Service\Cron\CronQuery;
use ilDBInterface;

class DeleteCronJobsCommand
{

    use CronQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    public function deleteCronJobs() : void
    {
        $this->ilias_database->manipulate($this->getDeleteCronJobQuery());
    }
}
