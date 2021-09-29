<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;

class DeleteOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private OrganisationalUnitPositionService $organisational_unit_position;


    public static function new(OrganisationalUnitPositionService $organisational_unit_position) : /*static*/ self
    {
        $command = new static();

        $command->organisational_unit_position = $organisational_unit_position;

        return $command;
    }


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return $this->deleteOrganisationalUnitPosition(
            $this->organisational_unit_position->getOrganisationalUnitPositionById(
                $id
            )
        );
    }


    private function deleteOrganisationalUnitPosition(?OrganisationalUnitPositionDto $organisational_unit_position) : ?OrganisationalUnitPositionIdDto
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

        $ilias_organisational_unit_position->deleteWithAllDependencies();

        return OrganisationalUnitPositionIdDto::new(
            $organisational_unit_position->getId()
        );
    }
}
