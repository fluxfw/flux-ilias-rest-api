<?php

namespace FluxIliasRestApi\Channel\Cron\Command;

use ilCronJob;

class GetCronJobCommand
{

    private array $cron_jobs;


    public static function new(array $cron_jobs) : /*static*/ self
    {
        $command = new static();

        $command->cron_jobs = $cron_jobs;

        return $command;
    }


    public function getCronJob(string $id) : ?ilCronJob
    {
        foreach ($this->cron_jobs as $cron_job) {
            if ($cron_job->getId() === $id) {
                return $cron_job;
            }
        }

        return null;
    }
}
