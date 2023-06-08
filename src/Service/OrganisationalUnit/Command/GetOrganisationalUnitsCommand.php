<?php

namespace FluxIliasRestApi\Service\OrganisationalUnit\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use FluxIliasRestApi\Service\OrganisationalUnit\OrganisationalUnitQuery;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use ilDBInterface;

class GetOrganisationalUnitsCommand
{

    use ObjectQuery;
    use OrganisationalUnitQuery;
    use TimestampQuery;

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
     * @return OrganisationalUnitDto[]
     */
    public function getOrganisationalUnits() : array
    {
        return array_map([$this, "mapOrganisationalUnitDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getOrganisationalUnitQuery())));
    }
}
