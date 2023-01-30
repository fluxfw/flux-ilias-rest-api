<?php

namespace FluxIliasRestApi\Service\Cron\Command;

use ilCronJob;

class GetCronJobCommand
{

    /**
     * @param ilCronJob[] $cron_jobs
     */
    private function __construct(
        private readonly array $cron_jobs
    ) {

    }


    /**
     * @param ilCronJob[] $cron_jobs
     */
    public static function new(
        array $cron_jobs
    ) : static {
        return new static(
            $cron_jobs
        );
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
