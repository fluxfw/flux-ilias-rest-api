<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command\CreateOrganisationalUnitCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command\GetOrganisationalUnitCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command\GetOrganisationalUnitRootCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command\GetOrganisationalUnitsCommand;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnit\Command\UpdateOrganisationalUnitCommand;
use ilDBInterface;

class OrganisationalUnitService
{

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;

        return $service;
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
            $this->database
        )
            ->getOrganisationalUnitByExternalId(
                $external_id
            );
    }


    public function getOrganisationalUnitById(int $id) : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitCommand::new(
            $this->database
        )
            ->getOrganisationalUnitById(
                $id
            );
    }


    public function getOrganisationalUnitByRefId(int $ref_id) : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitCommand::new(
            $this->database
        )
            ->getOrganisationalUnitByRefId(
                $ref_id
            );
    }


    public function getOrganisationalUnitRoot() : ?OrganisationalUnitDto
    {
        return GetOrganisationalUnitRootCommand::new(
            $this
        )
            ->getOrganisationalUnitRoot();
    }


    public function getOrganisationalUnits() : array
    {
        return GetOrganisationalUnitsCommand::new(
            $this->database
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
