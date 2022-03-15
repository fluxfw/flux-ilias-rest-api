<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;

class CreateOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private function __construct()
    {

    }


    public static function new() : /*static*/ self
    {
        return new static();
    }


    public function createOrganisationalUnitPosition(OrganisationalUnitPositionDiffDto $diff) : OrganisationalUnitPositionIdDto
    {
        $ilias_organisational_unit_position = $this->newIliasOrganisationalUnitPosition();

        $this->mapOrganisationalUnitPositionDiff(
            $diff,
            $ilias_organisational_unit_position
        );

        $ilias_organisational_unit_position->store();

        return OrganisationalUnitPositionIdDto::new(
            $ilias_organisational_unit_position->getId() ?: null
        );
    }
}
