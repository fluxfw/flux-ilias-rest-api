<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use ilDBInterface;

class GetOrganisationalUnitPositionsCommand
{

    use OrganisationalUnitPositionQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getOrganisationalUnitPositions() : array
    {
        return array_map([$this, "mapOrganisationalUnitPositionDto"], $this->database->fetchAll($this->database->query($this->getOrganisationalUnitPositionQuery())));
    }
}
