<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;

class CreateOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    public static function new() : /*static*/ self
    {
        $command = new static();

        return $command;
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
