<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;

class UpdateOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private OrganisationalUnitPositionService $organisational_unit_position;


    public static function new(OrganisationalUnitPositionService $organisational_unit_position) : /*static*/ self
    {
        $command = new static();

        $command->organisational_unit_position = $organisational_unit_position;

        return $command;
    }


    public function updateOrganisationalUnitPositionById(int $id, OrganisationalUnitPositionDiffDto $diff) : ?OrganisationalUnitPositionIdDto
    {
        return $this->updateOrganisationalUnitPosition(
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $id
            ),
            $diff
        );
    }


    private function updateOrganisationalUnitPosition(?OrganisationalUnitPositionDto $organisational_unit_position, OrganisationalUnitPositionDiffDto $diff) : ?OrganisationalUnitPositionIdDto
    {
        if ($organisational_unit_position === null) {
            return null;
        }

        $ilias_organisational_unit_position = $this->getIliasOrganisationalUnitPosition(
            $organisational_unit_position->getId()
        );
        if ($ilias_organisational_unit_position === null) {
            return null;
        }

        $this->mapOrganisationalUnitPositionDiff(
            $diff,
            $ilias_organisational_unit_position
        );

        $ilias_organisational_unit_position->store();

        return OrganisationalUnitPositionIdDto::new(
            $organisational_unit_position->getId()
        );
    }
}
