<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionAuthorityScopeIn;

class OrganisationalUnitPositionAuthorityScopeInMapping
{

    public static function mapExternalToInternal(LegacyOrganisationalUnitPositionAuthorityScopeIn $scope_in) : LegacyInternalOrganisationalUnitPositionAuthorityScopeIn
    {
        return LegacyInternalOrganisationalUnitPositionAuthorityScopeIn::from(array_flip(static::INTERNAL_EXTERNAL())[$scope_in->value] ?? substr($scope_in->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalOrganisationalUnitPositionAuthorityScopeIn $scope_in) : LegacyOrganisationalUnitPositionAuthorityScopeIn
    {
        return LegacyOrganisationalUnitPositionAuthorityScopeIn::from(static::INTERNAL_EXTERNAL()[$scope_in->value] ?? "_" . $scope_in->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalOrganisationalUnitPositionAuthorityScopeIn::SAME()->value                => LegacyOrganisationalUnitPositionAuthorityScopeIn::SAME()->value,
            LegacyInternalOrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT()->value => LegacyOrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT()->value
        ];
    }
}
