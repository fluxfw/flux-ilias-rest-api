<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Service\Change\ChangeQuery;
use FluxIliasRestApi\Service\Change\Port\ChangeService;
use ilDBInterface;

class PurgeChangesCommand
{

    use ChangeQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly ChangeService $change_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : static {
        return new static(
            $ilias_database,
            $change_service
        );
    }


    public function purgeChanges() : int
    {
        return $this->ilias_database->manipulate($this->getChangePurgeQuery(
            $this->change_service->getKeepChangesInsideDays()
        ));
    }
}
