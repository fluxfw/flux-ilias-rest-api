<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User;

final class InternalUserAuthenticationMode
{

    const CAS = "cas";
    const DEFAULT = "default";
    const LDAP = "ldap";
    const LOCAL = "local";
    const OPENID = "openid";
    const RADIUS = "radius";
    const SAML = "saml";
    const SCRIPT = "script";
    const SHIBBOLETH = "shibboleth";
    const SOAP = "soap";
}
