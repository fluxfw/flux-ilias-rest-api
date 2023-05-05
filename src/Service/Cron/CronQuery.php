<?php

namespace FluxIliasRestApi\Service\Cron;

use ilDBConstants;

trait CronQuery
{

    private function getDeleteCronJobQuery() : string
    {
        return "DELETE FROM cron_job
WHERE " . $this->ilias_database->like("component", ilDBConstants::T_TEXT, "flux\\_ilias\\_rest\\_%") . " AND " . $this->ilias_database->like("component", ilDBConstants::T_TEXT, "%\\_helper\\_plugin");
    }
}
