<?php

namespace FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition;

use JsonSerializable;

class OrganisationalUnitPositionAuthorityDto implements JsonSerializable
{

    private ?int $id;
    private ?int $over_position_id;
    private ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in;


    public static function new(?int $id = null, ?int $over_position_id = null, ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->over_position_id = $over_position_id;
        $dto->scope_in = $scope_in;

        return $dto;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getOverPositionId() : ?int
    {
        return $this->over_position_id;
    }


    public function getScopeIn() : ?LegacyOrganisationalUnitPositionAuthorityScopeIn
    {
        return $this->scope_in;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
