<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use ilObjOrgUnit;

class GetOrganisationalUnitRootCommand
{

    private OrganisationalUnitService $organisational_unit_service;


    private function __construct(
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service
    ) {
        $this->organisational_unit_service = $organisational_unit_service;
    }


    public static function new(
        OrganisationalUnitService $organisational_unit_service
    ) : /*static*/ self
    {
        return new static(
            $organisational_unit_service
        );
    }


    public function getOrganisationalUnitRoot() : ?OrganisationalUnitDto
    {
        return $this->organisational_unit_service->getOrganisationalUnitByRefId(
            ilObjOrgUnit::getRootOrgRefId()
        );
    }
}
