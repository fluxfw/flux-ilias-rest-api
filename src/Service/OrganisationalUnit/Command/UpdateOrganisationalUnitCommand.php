<?php

namespace FluxIliasRestApi\Service\OrganisationalUnit\Command;

use FluxIliasBaseApi\Adapter\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasBaseApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasBaseApi\Adapter\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Service\OrganisationalUnit\OrganisationalUnitQuery;
use FluxIliasRestApi\Service\OrganisationalUnit\Port\OrganisationalUnitService;

class UpdateOrganisationalUnitCommand
{

    use OrganisationalUnitQuery;

    private function __construct(
        private readonly OrganisationalUnitService $organisational_unit_service
    ) {

    }


    public static function new(
        OrganisationalUnitService $organisational_unit_service
    ) : static {
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
            $organisational_unit->id,
            $organisational_unit->ref_id
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
            $organisational_unit->id,
            $diff->external_id ?? $organisational_unit->external_id,
            $organisational_unit->ref_id
        );
    }
}
