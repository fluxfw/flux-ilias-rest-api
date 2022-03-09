<?php

namespace FluxIliasRestApi\Channel\User;

use FluxIliasRestApi\Adapter\Api\User\LegacyUserAuthenticationMode;

class UserAuthenticationModeMapping
{

    public static function mapExternalToInternal(LegacyUserAuthenticationMode $authentication_mode) : LegacyInternalUserAuthenticationMode
    {
        return LegacyInternalUserAuthenticationMode::from(array_flip(static::INTERNAL_EXTERNAL())[$authentication_mode->value] ?? substr($authentication_mode->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalUserAuthenticationMode $authentication_mode) : LegacyUserAuthenticationMode
    {
        return LegacyUserAuthenticationMode::from(static::INTERNAL_EXTERNAL()[$authentication_mode->value] ?? "_" . $authentication_mode->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalUserAuthenticationMode::CAS()->value        => LegacyUserAuthenticationMode::CAS()->value,
            LegacyInternalUserAuthenticationMode::DEFAULT()->value    => LegacyUserAuthenticationMode::DEFAULT()->value,
            LegacyInternalUserAuthenticationMode::LDAP()->value       => LegacyUserAuthenticationMode::LDAP()->value,
            LegacyInternalUserAuthenticationMode::LOCAL()->value      => LegacyUserAuthenticationMode::LOCAL()->value,
            LegacyInternalUserAuthenticationMode::OPENID()->value     => LegacyUserAuthenticationMode::OPENID()->value,
            LegacyInternalUserAuthenticationMode::RADIUS()->value     => LegacyUserAuthenticationMode::RADIUS()->value,
            LegacyInternalUserAuthenticationMode::SAML()->value       => LegacyUserAuthenticationMode::SAML()->value,
            LegacyInternalUserAuthenticationMode::SCRIPT()->value     => LegacyUserAuthenticationMode::SCRIPT()->value,
            LegacyInternalUserAuthenticationMode::SHIBBOLETH()->value => LegacyUserAuthenticationMode::SHIBBOLETH()->value,
            LegacyInternalUserAuthenticationMode::SOAP()->value       => LegacyUserAuthenticationMode::SOAP()->value
        ];
    }
}
