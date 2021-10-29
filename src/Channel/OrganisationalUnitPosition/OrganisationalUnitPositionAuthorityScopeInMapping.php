<?php

namespace FluxIliasRestApi\Channel\OrganisationalUnitPosition;

use FluxIliasRestApi\Adapter\Api\OrganisationalUnitPosition\OrganisationalUnitPositionAuthorityScopeIn;

final class OrganisationalUnitPositionAuthorityScopeInMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalOrganisationalUnitPositionAuthorityScopeIn::SAME                => OrganisationalUnitPositionAuthorityScopeIn::SAME,
            InternalOrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT => OrganisationalUnitPositionAuthorityScopeIn::SAME_AND_SUBSEQUENT
        ];


    public static function mapExternalToInternal(?string $authority_scope_in) : ?int
    {
        return ($authority_scope_in = $authority_scope_in ?: null) !== null ? array_flip(static::INTERNAL_EXTERNAL)[$authority_scope_in] ?? substr($authority_scope_in, 1) : null;
    }


    public static function mapInternalToExternal(?int $authority_scope_in) : ?string
    {
        return ($authority_scope_in = $authority_scope_in ?: null) !== null ? static::INTERNAL_EXTERNAL[$authority_scope_in] ?? "_" . $authority_scope_in : null;
    }
}
