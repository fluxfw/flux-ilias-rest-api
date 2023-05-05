<?php

namespace FluxIliasRestApi\Service\ObjectConfig;

use ilDBConstants;

trait ObjectConfigQuery
{

    private function getDeleteObjectConfigsQuery() : string
    {
        return "DELETE FROM container_settings
WHERE " . $this->ilias_database->like("keyword", ilDBConstants::T_TEXT, str_replace("_", "\\_", $this->getObjectConfigContainerSettingsPrefix()) . "%");
    }


    private function getObjectConfigContainerSettingsPrefix() : string
    {
        return "flilre_";
    }
}
