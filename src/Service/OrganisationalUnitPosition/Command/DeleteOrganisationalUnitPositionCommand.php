<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitPosition\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Service\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use FluxIliasRestApi\Service\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;

class DeleteOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private function __construct(
        private readonly OrganisationalUnitPositionService $organisational_unit_position_service
    ) {

    }


    public static function new(
        OrganisationalUnitPositionService $organisational_unit_position_service
    ) : static {
        return new static(
            $organisational_unit_position_service
        );
    }


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return $this->deleteOrganisationalUnitPosition(
            $this->organisational_unit_position_service->getOrganisationalUnitPositionById(
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
            $organisational_unit_position->id
        );
        if ($ilias_organisational_unit_position === null) {
            return null;
        }

        $ilias_organisational_unit_position->deleteWithAllDependencies();

        return OrganisationalUnitPositionIdDto::new(
            $organisational_unit_position->id
        );
    }
}
