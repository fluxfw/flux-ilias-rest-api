<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use FluxIliasRestApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;

class CreateOrganisationalUnitCommand
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


    public function createOrganisationalUnitToExternalId(string $parent_external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->createOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByExternalId(
                $parent_external_id
            ),
            $diff
        );
    }


    public function createOrganisationalUnitToId(int $parent_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->createOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitById(
                $parent_id
            ),
            $diff
        );
    }


    public function createOrganisationalUnitToRefId(int $parent_ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return $this->createOrganisationalUnit(
            $this->organisational_unit_service->getOrganisationalUnitByRefId(
                $parent_ref_id
            ),
            $diff
        );
    }


    private function createOrganisationalUnit(?OrganisationalUnitDto $parent_organisational_unit, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        if ($parent_organisational_unit === null || $parent_organisational_unit->getRefId() === null) {
            return null;
        }

        $ilias_organisational_unit = $this->newIliasOrganisationalUnit();

        $ilias_organisational_unit->setTitle($diff->getTitle() ?? "");

        $ilias_organisational_unit->create();
        $ilias_organisational_unit->createReference();
        $ilias_organisational_unit->putInTree($parent_organisational_unit->getRefId());
        $ilias_organisational_unit->setPermissions($parent_organisational_unit->getRefId());

        $this->mapOrganisationalUnitDiff(
            $diff,
            $ilias_organisational_unit
        );

        $ilias_organisational_unit->update();

        return OrganisationalUnitIdDto::new(
            $ilias_organisational_unit->getId() ?: null,
            $diff->getExternalId(),
            $ilias_organisational_unit->getRefId() ?: null
        );
    }
}
