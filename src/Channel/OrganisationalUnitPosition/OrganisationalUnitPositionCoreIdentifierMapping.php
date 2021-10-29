<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionCoreIdentifier;

final class OrganisationalUnitPositionCoreIdentifierMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalOrganisationalUnitPositionCoreIdentifier::EMPLOYEE => OrganisationalUnitPositionCoreIdentifier::EMPLOYEE,
            InternalOrganisationalUnitPositionCoreIdentifier::SUPERIOR => OrganisationalUnitPositionCoreIdentifier::SUPERIOR
        ];


    public static function mapExternalToInternal(?string $organisational_unit_position_core_identifier) : ?int
    {
        return ($organisational_unit_position_core_identifier = $organisational_unit_position_core_identifier ?: null) !== null
            ? array_flip(static::INTERNAL_EXTERNAL)[$organisational_unit_position_core_identifier] ??
            substr($organisational_unit_position_core_identifier, 1) : null;
    }


    public static function mapInternalToExternal(?int $organisational_unit_position_core_identifier) : ?string
    {
        return ($organisational_unit_position_core_identifier = $organisational_unit_position_core_identifier ?: null) !== null
            ? static::INTERNAL_EXTERNAL[$organisational_unit_position_core_identifier] ?? "_" . $organisational_unit_position_core_identifier : null;
    }
}
