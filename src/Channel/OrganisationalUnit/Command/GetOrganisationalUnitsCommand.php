<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use ilDBInterface;

class GetOrganisationalUnitsCommand
{

    use ObjectQuery;
    use OrganisationalUnitQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getOrganisationalUnits() : array
    {
        return array_map([$this, "mapOrganisationalUnitDto"], $this->database->fetchAll($this->database->query($this->getOrganisationalUnitQuery())));
    }
}
