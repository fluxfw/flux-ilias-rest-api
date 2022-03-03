<?php

namespace FluxIliasRestApi\Channel\Cron\Command;

use FluxIliasRestApi\Channel\Cron\CronQuery;
use ilDBInterface;

class DeleteCronJobsCommand
{

    use CronQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function deleteCronJobs() : void
    {
        $this->database->manipulate($this->getDeleteCronJobQuery());
    }
}
