<?php

namespace FluxIliasRestApi\Channel\Cron\Command;

use FluxIliasRestApi\Channel\Cron\CronQuery;
use ilDBInterface;

class DeleteCronJobsCommand
{

    use CronQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function deleteCronJobs() : void
    {
        $this->ilias_database->manipulate($this->getDeleteCronJobQuery());
    }
}
