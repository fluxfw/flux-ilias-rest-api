<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnit\Command;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnit\OrganisationalUnitDto;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use FluxIliasRestApi\Channel\OrganisationalUnit\OrganisationalUnitQuery;
use ilDBInterface;
use LogicException;

class GetOrganisationalUnitCommand
{

    use ObjectQuery;
    use OrganisationalUnitQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getOrganisationalUnitByExternalId(string $external_id) : ?OrganisationalUnitDto
    {
        $organisational_unit = null;
        while (($organisational_unit_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getOrganisationalUnitQuery(
                null,
                $external_id
            )))) !== null) {
            if ($organisational_unit !== null) {
                throw new LogicException("Multiple organisational units found with the external id " . $external_id);
            }
            $organisational_unit = $this->mapOrganisationalUnitDto(
                $organisational_unit_
            );
        }

        return $organisational_unit;
    }


    public function getOrganisationalUnitById(int $id) : ?OrganisationalUnitDto
    {
        $organisational_unit = null;
        while (($organisational_unit_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getOrganisationalUnitQuery(
                $id
            )))) !== null) {
            if ($organisational_unit !== null) {
                throw new LogicException("Multiple organisational units found with the id " . $id);
            }
            $organisational_unit = $this->mapOrganisationalUnitDto(
                $organisational_unit_
            );
        }

        return $organisational_unit;
    }


    public function getOrganisationalUnitByRefId(int $ref_id) : ?OrganisationalUnitDto
    {
        $organisational_unit = null;
        while (($organisational_unit_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getOrganisationalUnitQuery(
                null,
                null,
                $ref_id
            )))) !== null) {
            if ($organisational_unit !== null) {
                throw new LogicException("Multiple organisational units found with the ref id " . $ref_id);
            }
            $organisational_unit = $this->mapOrganisationalUnitDto(
                $organisational_unit_
            );
        }

        return $organisational_unit;
    }
}
