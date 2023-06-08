<?php

namespace FluxIliasRestApi\Service\Change\Command;

use FluxIliasRestApi\Adapter\Change\ChangeDto;
use FluxIliasRestApi\Service\Change\ChangeQuery;
use ilDBInterface;

class GetChangesCommand
{

    use ChangeQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return ChangeDto[]
     */
    public function getChanges(?float $time = null, ?float $time_from = null, ?float $time_to = null, ?float $time_after = null, ?float $time_before = null) : array
    {
        return array_map([$this, "mapChangeDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getChangeQuery(
            $time,
            $time_from,
            $time_to,
            $time_after,
            $time_before
        ))));
    }
}
