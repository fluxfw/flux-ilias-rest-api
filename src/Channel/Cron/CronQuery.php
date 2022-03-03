<?php

namespace FluxIliasRestApi\Channel\Cron;

use ilDBConstants;

trait CronQuery
{

    private function getDeleteCronJobQuery() : string
    {
        return "DELETE FROM cron_job
WHERE " . $this->database->like("component", ilDBConstants::T_TEXT, "flux_ilias_rest_%%") . " AND " . $this->database->like("component", ilDBConstants::T_TEXT, "%%_helper_plugin");
    }
}
