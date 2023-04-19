<?php

namespace FluxIliasRestApi\Adapter\User;

enum UserAuthenticationMode: string
{

    case APACHE = "apache";
    case CAS = "cas";
    case DEFAULT = "default";
    case ECS = "ecs";
    case LDAP = "ldap";
    case LOCAL = "local";
    case LTI = "lti";
    case OPEN_ID_CONNECT = "open-id-connect";
    case RADIUS = "radius";
    case SAML = "saml";
    case SCRIPT = "script";
    case SHIBBOLETH = "shibboleth";
    case SOAP = "soap";
}
