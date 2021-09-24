<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use ilObjOrgUnit;

class GetOrganisationalUnitRootCommand
{

    private OrganisationalUnitService $organisational_unit;


    public static function new(OrganisationalUnitService $organisational_unit) : /*static*/ self
    {
        $command = new static();

        $command->organisational_unit = $organisational_unit;

        return $command;
    }


    public function getOrganisationalUnitRoot() : ?OrganisationalUnitDto
    {
        return $this->organisational_unit->getOrganisationalUnitByRefId(
            ilObjOrgUnit::getRootOrgRefId()
        );
    }
}
