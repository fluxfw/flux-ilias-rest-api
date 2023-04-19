<?php

namespace FluxIliasRestApi\Service\User;

enum InternalUserAuthenticationMode: string
{

    case APACHE = "apache";
    case CAS = "cas";
    case DEFAULT = "default";
    case ECS = "ecs";
    case LDAP = "ldap";
    case LOCAL = "local";
    case LTI = "lti";
    case OIDC = "oidc";
    case RADIUS = "radius";
    case SAML = "saml";
    case SCRIPT = "script";
    case SHIBBOLETH = "shibboleth";
    case SOAP = "soap";
}
