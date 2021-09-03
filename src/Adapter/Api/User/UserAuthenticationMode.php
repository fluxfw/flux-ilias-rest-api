<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\User;

final class UserAuthenticationMode
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
