<?php

namespace FluxIliasRestApi\Adapter\CronConfig\Wrapper;

use ilCronJob;
use ilObjUser;

interface IliasCronWrapper
{

    public function activateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void;


    public function deactivateJob(ilCronJob $job, ilObjUser $actor, bool $wasManuallyExecuted = false) : void;


    public function getCronJobData(?string $id = null, bool $withInactiveJobsIncluded = true) : array;


    public function isJobActive(string $jobId) : bool;


    public function updateJobSchedule(ilCronJob $job, ?int $scheduleType, ?int $scheduleValue) : void;
}
