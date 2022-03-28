<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;
use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use ilDBInterface;
use LogicException;

class GetOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

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


    public function getOrganisationalUnitPositionByCoreIdentifier(LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier) : ?OrganisationalUnitPositionDto
    {
        $organisational_unit_position = null;
        while (($organisational_unit_position_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getOrganisationalUnitPositionQuery(
                null,
                $core_identifier
            )))) !== null) {
            if ($organisational_unit_position !== null) {
                throw new LogicException("Multiple organisational units found with the core identifier " . $core_identifier);
            }
            $organisational_unit_position = $this->mapOrganisationalUnitPositionDto(
                $organisational_unit_position_
            );
        }

        return $organisational_unit_position;
    }


    public function getOrganisationalUnitPositionById(int $id) : ?OrganisationalUnitPositionDto
    {
        $organisational_unit_position = null;
        while (($organisational_unit_position_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getOrganisationalUnitPositionQuery(
                $id
            )))) !== null) {
            if ($organisational_unit_position !== null) {
                throw new LogicException("Multiple organisational units found with the id " . $id);
            }
            $organisational_unit_position = $this->mapOrganisationalUnitPositionDto(
                $organisational_unit_position_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getOrganisationalUnitPositionAuthorityQuery(array_filter([$organisational_unit_position_["id"]]))))
            );
        }

        return $organisational_unit_position;
    }
}
