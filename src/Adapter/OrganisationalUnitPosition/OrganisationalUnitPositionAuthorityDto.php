<?php

namespace FluxIliasRestApi\Adapter\OrganisationalUnitPosition;

use JsonSerializable;

class OrganisationalUnitPositionAuthorityDto implements JsonSerializable
{

    private ?int $id;
    private ?int $over_position_id;
    private ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?int $over_position_id,
        /*public readonly*/ ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in
    ) {
        $this->id = $id;
        $this->over_position_id = $over_position_id;
        $this->scope_in = $scope_in;
    }


    public static function new(
        ?int $id = null,
        ?int $over_position_id = null,
        ?LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $over_position_id,
            $scope_in
        );
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
