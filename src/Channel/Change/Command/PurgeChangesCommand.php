<?php

namespace FluxIliasRestApi\Channel\Change\Command;

use FluxIliasRestApi\Channel\Change\ChangeQuery;
use FluxIliasRestApi\Channel\Change\Port\ChangeService;
use ilDBInterface;

class PurgeChangesCommand
{

    use ChangeQuery;

    private ChangeService $change_service;
    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ChangeService $change_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->change_service = $change_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ChangeService $change_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $change_service
        );
    }


    public function purgeChanges() : ?int
    {
        if (!$this->changeDatabaseExists()) {
            return null;
        }

        return $this->ilias_database->manipulate($this->getChangePurgeQuery(
            $this->change_service->getKeepChangesInsideDays()
        ));
    }
}
