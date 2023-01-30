<?php

namespace FluxIliasRestApi\Service\CronConfig\Command;

use FluxIliasRestApi\Adapter\CronConfig\Wrapper\IliasCronWrapper;
use ilCronJob;

class IsCronJobEnabledCommand
{

    private function __construct(
        private readonly IliasCronWrapper $ilias_cron_wrapper
    ) {

    }


    public static function new(
        IliasCronWrapper $ilias_cron_wrapper
    ) : static {
        return new static(
            $ilias_cron_wrapper
        );
    }


    public function isCronJobEnabled(ilCronJob $cron_job) : bool
    {
        return $this->ilias_cron_wrapper->isJobActive($cron_job->getId());
    }
}
