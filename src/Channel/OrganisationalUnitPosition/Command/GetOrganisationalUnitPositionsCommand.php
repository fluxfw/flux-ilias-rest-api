<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionDto;
use FluxIliasRestApi\Channel\OrganisationalUnitPosition\OrganisationalUnitPositionQuery;
use ilDBInterface;

class GetOrganisationalUnitPositionsCommand
{

    use OrganisationalUnitPositionQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getOrganisationalUnitPositions(bool $authorities = false) : array
    {
        $organisational_unit_positions = $this->database->fetchAll($this->database->query($this->getOrganisationalUnitPositionQuery()));
        $position_ids = array_map(fn(array $position) : int => $position["id"], $organisational_unit_positions);

        $authorities_ = $authorities ? $this->database->fetchAll($this->database->query($this->getOrganisationalUnitPositionAuthorityQuery($position_ids))) : null;

        return array_map(fn(array $organisational_unit_position) : OrganisationalUnitPositionDto => $this->mapOrganisationalUnitPositionDto(
            $organisational_unit_position,
            $authorities_
        ), $organisational_unit_positions);
    }
}
