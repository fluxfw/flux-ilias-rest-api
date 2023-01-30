<?php

namespace FluxIliasRestApi\Service\OrganisationalUnitPosition;

enum InternalOrganisationalUnitPositionAuthorityScopeIn: int
{

    case SAME = 1;
    case SAME_AND_SUBSEQUENT = 2;
}

// ilOrgUnitAuthority::SCOPE_SAME_ORGU
// ilOrgUnitAuthority::SCOPE_SUBSEQUENT_ORGUS
