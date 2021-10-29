<?php

namespace FluxIliasRestApi\Channel\User;

use FluxIliasRestApi\Adapter\Api\User\UserAuthenticationMode;

final class UserAuthenticationModeMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalUserAuthenticationMode::CAS        => UserAuthenticationMode::CAS,
            InternalUserAuthenticationMode::DEFAULT    => UserAuthenticationMode::DEFAULT,
            InternalUserAuthenticationMode::LDAP       => UserAuthenticationMode::LDAP,
            InternalUserAuthenticationMode::LOCAL      => UserAuthenticationMode::LOCAL,
            InternalUserAuthenticationMode::OPENID     => UserAuthenticationMode::OPENID,
            InternalUserAuthenticationMode::RADIUS     => UserAuthenticationMode::RADIUS,
            InternalUserAuthenticationMode::SAML       => UserAuthenticationMode::SAML,
            InternalUserAuthenticationMode::SCRIPT     => UserAuthenticationMode::SCRIPT,
            InternalUserAuthenticationMode::SHIBBOLETH => UserAuthenticationMode::SHIBBOLETH,
            InternalUserAuthenticationMode::SOAP       => UserAuthenticationMode::SOAP
        ];


    public static function mapExternalToInternal(?string $authentication_mode) : string
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$authentication_mode = $authentication_mode ?: UserAuthenticationMode::DEFAULT] ?? substr($authentication_mode, 1);
    }


    public static function mapInternalToExternal(?string $authentication_mode) : string
    {
        return static::INTERNAL_EXTERNAL[$authentication_mode = $authentication_mode ?: InternalUserAuthenticationMode::DEFAULT] ?? "_" . $authentication_mode;
    }
}
