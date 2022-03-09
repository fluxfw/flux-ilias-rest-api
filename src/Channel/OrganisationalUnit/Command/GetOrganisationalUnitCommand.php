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


    public function getOrganisationalUnitByExternalId(string $external_id) : ?OrganisationalUnitDto
    {
        $organisational_unit = null;
        while (($organisational_unit_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getOrganisationalUnitQuery(
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
        while (($organisational_unit_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getOrganisationalUnitQuery(
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
        while (($organisational_unit_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getOrganisationalUnitQuery(
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
