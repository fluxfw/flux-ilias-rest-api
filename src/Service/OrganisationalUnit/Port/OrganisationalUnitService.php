<?php

namespace FluxIliasRestApi\Service\OrganisationalUnit\Port;

use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDiffDto;
use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Adapter\OrganisationalUnit\OrganisationalUnitIdDto;
use FluxIliasRestApi\Service\OrganisationalUnit\Command\CreateOrganisationalUnitCommand;
use FluxIliasRestApi\Service\OrganisationalUnit\Command\GetOrganisationalUnitCommand;
use FluxIliasRestApi\Service\OrganisationalUnit\Command\GetOrganisationalUnitsCommand;
use FluxIliasRestApi\Service\OrganisationalUnit\Command\UpdateOrganisationalUnitCommand;
use ilDBInterface;

class OrganisationalUnitService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    public function createOrganisationalUnitToExternalId(string $parent_external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return CreateOrganisationalUnitCommand::new(
            $this
        )
            ->createOrganisationalUnitToExternalId(
                $parent_external_id,
                $diff
            );
    }


    public function createOrganisationalUnitToId(int $parent_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return CreateOrganisationalUnitCommand::new(
            $this
        )
            ->createOrganisationalUnitToId(
                $parent_id,
                $diff
            );
    }


    public function createOrganisationalUnitToRefId(int $parent_ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return CreateOrganisationalUnitCommand::new(
            $this
        )
            ->createOrganisationalUnitToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getOrganisationalUnitByExternalId(string $external_id) : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitByExternalId(
                $external_id
            );
    }


    public function getOrganisationalUnitById(int $id) : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitById(
                $id
            );
    }


    public function getOrganisationalUnitByRefId(int $ref_id) : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitByRefId(
                $ref_id
            );
    }


    /**
     * @return OrganisationalUnitDto[]
     */
    public function getOrganisationalUnits() : array
    {
        return GetOrganisationalUnitsCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnits();
    }


    public function updateOrganisationalUnitByExternalId(string $external_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return UpdateOrganisationalUnitCommand::new(
            $this
        )
            ->updateOrganisationalUnitByExternalId(
                $external_id,
                $diff
            );
    }


    public function updateOrganisationalUnitById(int $id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return UpdateOrganisationalUnitCommand::new(
            $this
        )
            ->updateOrganisationalUnitById(
                $id,
                $diff
            );
    }


    public function updateOrganisationalUnitByRefId(int $ref_id, OrganisationalUnitDiffDto $diff) : ?OrganisationalUnitIdDto
    {
        return UpdateOrganisationalUnitCommand::new(
            $this
        )
            ->updateOrganisationalUnitByRefId(
                $ref_id,
                $diff
            );
    }
}
