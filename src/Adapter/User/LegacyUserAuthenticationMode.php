<?php

namespace FluxIliasRestApi\Adapter\User;

use FluxIliasRestApi\Libs\FluxLegacyEnum\Adapter\Backed\LegacyStringBackedEnum;

/**
 * @method static static CAS() cas
 * @method static static DEFAULT() default
 * @method static static LDAP() ldap
 * @method static static LOCAL() local
 * @method static static OPENID() openid
 * @method static static RADIUS() radius
 * @method static static SAML() saml
 * @method static static SCRIPT() script
 * @method static static SHIBBOLETH() shibboleth
 * @method static static SOAP() soap
 */
class LegacyUserAuthenticationMode extends LegacyStringBackedEnum
{

}
