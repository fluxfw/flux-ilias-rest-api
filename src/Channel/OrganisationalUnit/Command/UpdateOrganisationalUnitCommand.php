<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;

class UpdateOrganisationalUnitCommand
{

    use OrganisationalUnitQuery;

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


    public function updateOrganisationalUnitByExternalId(string $external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitById(int $id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitById(
                $id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitByRefId(int $ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $ref_id
            ),
            $diff
        );
    }


    private function updateOrganisationalUnit(?OrganisationalUnitDto $organisational_unit, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        if ($organisational_unit === null) {
            return null;
        }

        $ilias_organisational_unit = $this->getIliasOrganisationalUnit(
            $organisational_unit->getId(),
            $organisational_unit->getRefId()
        );
        if ($ilias_organisational_unit === null) {
            return null;
        }

        $this->mapOrganisationalUnitDiff(
            $diff,
            $ilias_organisational_unit
        );

        $ilias_organisational_unit->update();

        return OrganisationalUnitIdDto::new(
            $organisational_unit->getId(),
            $diff->getExternalId() ?? $organisational_unit->getExternalId(),
            $organisational_unit->getRefId()
        );
    }
}
