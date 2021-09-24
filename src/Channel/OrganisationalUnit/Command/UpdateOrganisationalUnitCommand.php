<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;

class UpdateOrganisationalUnitCommand
{

    use OrganisationalUnitQuery;

    private OrganisationalUnitService $organisational_unit;


    public static function new(OrganisationalUnitService $organisational_unit) : /*static*/ self
    {
        $command = new static();

        $command->organisational_unit = $organisational_unit;

        return $command;
    }


    public function updateOrganisationalUnitByExternalId(string $external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit->getOrganisationalUnitByExternalId(
                $external_id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitById(int $id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit->getOrganisationalUnitById(
                $id
            ),
            $diff
        );
    }


    public function updateOrganisationalUnitByRefId(int $ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->updateOrganisationalUnit(
            $this->organisational_unit->getOrganisationalUnitByRefId(
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
