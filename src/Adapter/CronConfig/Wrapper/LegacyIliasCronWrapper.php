<?php

namespace FluxIliasRestApi\Adapter\CronConfig\Wrapper;

use ilCronJob;
use ilCronManager;
use ilObjUser;

class LegacyIliasCronWrapper implements IliasCronWrapper
{

    private function __construct()
    {

    }


    public static function new() : static
    {
        return new static();
    }


    public function activateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void
    {
        ilCronManager::activateJob($job, $wasManuallyExecuted);
    }


    public function deactivateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void
    {
        ilCronManager::deactivateJob($job, $wasManuallyExecuted);
    }


    public function getCronJobData(?string $id = null, bool $withInactiveJobsIncluded = true) : array
    {
        return ilCronManager::getCronJobData($id, $withInactiveJobsIncluded);
    }


    public function isJobActive(string $jobId) : bool
    {
        return ilCronManager::isJobActive($jobId);
    }


    public function updateJobSchedule(ilCronJob $job, ?int $scheduleType, ?int $scheduleValue) : void
    {
        ilCronManager::updateJobSchedule($job, $scheduleType, $scheduleValue);
    }
}
