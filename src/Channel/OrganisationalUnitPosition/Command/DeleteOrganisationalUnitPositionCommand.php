<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port\OrganisationalUnitPositionService;

class DeleteOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private OrganisationalUnitPositionService $organisational_unit_position_service;


    private function __construct(
        /*private readonly*/ OrganisationalUnitPositionService $organisational_unit_position_service
    ) {
        $this->organisational_unit_position_service = $organisational_unit_position_service;
    }


    public static function new(
        OrganisationalUnitPositionService $organisational_unit_position_service
    ) : /*static*/ self
    {
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
