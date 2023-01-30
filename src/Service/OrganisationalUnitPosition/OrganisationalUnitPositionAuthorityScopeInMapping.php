<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitPosition;

use FluxIliasBaseApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionAuthorityScopeIn;

class OrganisationalUnitPositionAuthorityScopeInMapping
{

    public static function mapExternalToInternal(OrganisationalUnitPositionAuthorityScopeIn $scope_in) : InternalOrganisationalUnitPositionAuthorityScopeIn
    {
        return InternalOrganisationalUnitPositionAuthorityScopeIn::from(array_flip(static::INTERNAL_EXTERNAL())[$scope_in->value] ?? substr($scope_in->value, 1));
    }


    public static function mapInternalToExternal(InternalOrganisationalUnitPositionAuthorityScopeIn $scope_in) : OrganisationalUnitPositionAuthorityScopeIn
    {
        return OrganisationalUnitPositionAuthorityScopeIn::from(static::INTERNAL_EXTERNAL()[$scope_in->value] ?? "_" . $scope_in->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalOrganisationalUnitPositionAuthorityScopeIn::SAME->value                => OrganisationalUnitPositionAuthorityScopeIn::SAME->value,
            InternalOrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT->value => OrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT->value
        ];
    }
}
