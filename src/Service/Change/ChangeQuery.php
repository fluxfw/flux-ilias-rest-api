<?php

namespace FluxIliasRestApi\Service\Change;

use FluxIliasRestApi\Adapter\Change\ChangeDto;
use FluxIliasRestApi\Adapter\Change\ChangeType;
use ilDBConstants;

trait ChangeQuery
{

    private function changeDatabaseExists() : bool
    {
        return $this->ilias_database->tableExists($this->getChangeDatabaseTable());
    }


    private function getChangeDatabaseTable() : string
    {
        return "flilre_change";
    }


    private function getChangePurgeQuery(int $keep_changes_inside_days) : string
    {
        return "DELETE FROM " . $this->ilias_database->quoteIdentifier($this->getChangeDatabaseTable()) . "
WHERE time<" . $this->ilias_database->quote(time() - ($keep_changes_inside_days * 24 * 60 * 60), ilDBConstants::T_FLOAT);
    }


    private function getChangeQuery(?float $time = null, ?float $time_from = null, ?float $time_to = null, ?float $time_after = null, ?float $time_before = null) : string
    {
        $wheres = [];

        if ($time !== null) {
            $wheres[] = "time=" . $this->ilias_database->quote($time, ilDBConstants::T_FLOAT);
        }

        if ($time_from !== null) {
            $wheres[] = "time>=" . $this->ilias_database->quote($time_from, ilDBConstants::T_FLOAT);
        }

        if ($time_to !== null) {
            $wheres[] = "time<=" . $this->ilias_database->quote($time_to, ilDBConstants::T_FLOAT);
        }

        if ($time_after !== null) {
            $wheres[] = "time>" . $this->ilias_database->quote($time_after, ilDBConstants::T_FLOAT);
        }

        if ($time_before !== null) {
            $wheres[] = "time<" . $this->ilias_database->quote($time_before, ilDBConstants::T_FLOAT);
        }

        return "SELECT *
FROM " . $this->ilias_database->quoteIdentifier($this->getChangeDatabaseTable()) . "
" . (!empty($wheres) ? "WHERE " . implode(" AND ", $wheres) : "") . "
ORDER BY time ASC";
    }


    private function mapChangeDto(array $change) : ChangeDto
    {
        return ChangeDto::new(
            $change["id"],
            ChangeType::from($change["type"]),
            $change["time"],
            $change["user_id"],
            $change["user_import_id"] ?: null,
            json_decode($change["data"])
        );
    }
}
