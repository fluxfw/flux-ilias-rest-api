<?php

namespace FluxIliasRestApi\Adapter\CronConfig\Wrapper;

use ilCronJob;
use ilCronServices;
use ilObjUser;

class NewIliasCronWrapper implements IliasCronWrapper
{

    private function __construct(
        private readonly ilCronServices $ilias_cron
    ) {

    }


    public static function new(
        ilCronServices $ilias_cron
    ) : static {
        return new static(
            $ilias_cron
        );
    }


    public function activateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void
    {
        $this->ilias_cron->manager()->activateJob($job, $actor, $wasManuallyExecuted);
    }


    public function deactivateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void
    {
        $this->ilias_cron->manager()->deactivateJob($job, $actor, $wasManuallyExecuted);
    }


    public function getCronJobData(?string $id = null, bool $withInactiveJobsIncluded = true) : array
    {
        return $this->ilias_cron->repository()->getCronJobData($id, $withInactiveJobsIncluded);
    }


    public function isJobActive(string $jobId) : bool
    {
        return $this->ilias_cron->manager()->isJobActive($jobId);
    }


    public function updateJobSchedule(ilCronJob $job, ?int $scheduleType, ?int $scheduleValue) : void
    {
        $this->ilias_cron->repository()->updateJobSchedule($job, $scheduleType, $scheduleValue);
    }
}
