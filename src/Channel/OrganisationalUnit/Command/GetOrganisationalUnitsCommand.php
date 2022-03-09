<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use ilDBInterface;

class GetOrganisationalUnitsCommand
{

    use ObjectQuery;
    use OrganisationalUnitQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function getOrganisationalUnits() : array
    {
        return array_map([$this, "mapOrganisationalUnitDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getOrganisationalUnitQuery())));
    }
}
