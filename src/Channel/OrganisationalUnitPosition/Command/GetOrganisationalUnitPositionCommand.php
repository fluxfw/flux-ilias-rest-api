<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use Fluxlabs\FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use ilDBInterface;
use LogicException;

class GetOrganisationalUnitPositionCommand
{

    use OrganisationalUnitPositionQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getOrganisationalUnitPositionByCoreIdentifier(string $core_identifier) : ?OrganisationalUnitPositionDto
    {
        $organisational_unit_position = null;
        while (($organisational_unit_position_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getOrganisationalUnitPositionQuery(
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
        while (($organisational_unit_position_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getOrganisationalUnitPositionQuery(
                $id
            )))) !== null) {
            if ($organisational_unit_position !== null) {
                throw new LogicException("Multiple organisational units found with the id " . $id);
            }
            $organisational_unit_position = $this->mapOrganisationalUnitPositionDto(
                $organisational_unit_position_,
                $this->database->fetchAll($this->database->query($this->getOrganisationalUnitPositionAuthorityQuery(array_filter([$organisational_unit_position_["id"]]))))
            );
        }

        return $organisational_unit_position;
    }
}
