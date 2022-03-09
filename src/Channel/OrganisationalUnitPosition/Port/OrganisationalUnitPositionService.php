<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition\Port;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDiffDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionIdDto;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command\CreateOrganisationalUnitPositionCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command\DeleteOrganisationalUnitPositionCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command\GetOrganisationalUnitPositionsCommand;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command\UpdateOrganisationalUnitPositionCommand;
use ilDBInterface;

class OrganisationalUnitPositionService
{

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function createOrganisationalUnitPosition(OrganisationalUnitPositionDiffDto $diff) : OrganisationalUnitPositionIdDto
    {
        return CreateOrganisationalUnitPositionCommand::new()
            ->createOrganisationalUnitPosition(
                $diff
            );
    }


    public function deleteOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionIdDto
    {
        return DeleteOrganisationalUnitPositionCommand::new(
            $this
        )
            ->deleteOrganisationalUnitPositionById(
                $id
            );
    }


    public function getOrganisationalUnitPositionByCoreIdentifier(LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier) : ?OrganisationalUnitPositionDto
    {
        return GetOrganisationalUnitPositionCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositionByCoreIdentifier(
                $core_identifier
            );
    }


    public function getOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionDto
    {
        return GetOrganisationalUnitPositionCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositionById(
                $id
            );
    }


    public function getOrganisationalUnitPositions(bool $authorities = false) : array
    {
        return GetOrganisationalUnitPositionsCommand::new(
            $this->ilias_database
        )
            ->getOrganisationalUnitPositions(
                $authorities
            );
    }


    public function updateOrganisationalUnitPositionById(int $id, OrganisationalUnitPositionDiffDto $diff) : ?OrganisationalUnitPositionIdDto
    {
        return UpdateOrganisationalUnitPositionCommand::new(
            $this
        )
            ->updateOrganisationalUnitPositionById(
                $id,
                $diff
            );
    }
}
