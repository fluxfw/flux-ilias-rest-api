<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\LegacyOrganisationalUnitPositionCoreIdentifier;

class OrganisationalUnitPositionCoreIdentifierMapping
{

    public static function mapExternalToInternal(LegacyOrganisationalUnitPositionCoreIdentifier $core_identifier) : LegacyInternalOrganisationalUnitPositionCoreIdentifier
    {
        return LegacyInternalOrganisationalUnitPositionCoreIdentifier::from(array_flip(static::INTERNAL_EXTERNAL())[$core_identifier->value] ?? substr($core_identifier->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalOrganisationalUnitPositionCoreIdentifier $core_identifier) : LegacyOrganisationalUnitPositionCoreIdentifier
    {
        return LegacyOrganisationalUnitPositionCoreIdentifier::from(static::INTERNAL_EXTERNAL()[$core_identifier->value] ?? "_" . $core_identifier->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalOrganisationalUnitPositionCoreIdentifier::EMPLOYEE()->value => LegacyOrganisationalUnitPositionCoreIdentifier::EMPLOYEE()->value,
            LegacyInternalOrganisationalUnitPositionCoreIdentifier::SUPERIOR()->value => LegacyOrganisationalUnitPositionCoreIdentifier::SUPERIOR()->value
        ];
    }
}
