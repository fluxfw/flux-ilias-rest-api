<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\OrganisationalUnitPosition\OrganisationalUnitPositionCoreIdentifier;

class OrganisationalUnitPositionCoreIdentifierMapping
{

    public static function mapExternalToInternal(OrganisationalUnitPositionCoreIdentifier $core_identifier) : InternalOrganisationalUnitPositionCoreIdentifier
    {
        return InternalOrganisationalUnitPositionCoreIdentifier::from(array_flip(static::INTERNAL_EXTERNAL())[$core_identifier->value] ?? substr($core_identifier->value, 1));
    }


    public static function mapInternalToExternal(InternalOrganisationalUnitPositionCoreIdentifier $core_identifier) : OrganisationalUnitPositionCoreIdentifier
    {
        return OrganisationalUnitPositionCoreIdentifier::from(static::INTERNAL_EXTERNAL()[$core_identifier->value] ?? "_" . $core_identifier->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalOrganisationalUnitPositionCoreIdentifier::EMPLOYEE->value => OrganisationalUnitPositionCoreIdentifier::EMPLOYEE->value,
            InternalOrganisationalUnitPositionCoreIdentifier::SUPERIOR->value => OrganisationalUnitPositionCoreIdentifier::SUPERIOR->value
        ];
    }
}
