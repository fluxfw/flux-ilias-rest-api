<?php

namespace FluxIliasRestApi\Service\User;

use FluxIliasRestApi\Adapter\User\UserAuthenticationMode;

class UserAuthenticationModeMapping
{

    public static function mapExternalToInternal(UserAuthenticationMode $authentication_mode) : InternalUserAuthenticationMode
    {
        return InternalUserAuthenticationMode::from(array_flip(static::INTERNAL_EXTERNAL())[$authentication_mode->value] ?? substr($authentication_mode->value, 1));
    }


    public static function mapInternalToExternal(InternalUserAuthenticationMode $authentication_mode) : UserAuthenticationMode
    {
        return UserAuthenticationMode::from(static::INTERNAL_EXTERNAL()[$authentication_mode->value] ?? "_" . $authentication_mode->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalUserAuthenticationMode::APACHE->value     => UserAuthenticationMode::APACHE->value,
            InternalUserAuthenticationMode::CAS->value        => UserAuthenticationMode::CAS->value,
            InternalUserAuthenticationMode::DEFAULT->value    => UserAuthenticationMode::DEFAULT->value,
            InternalUserAuthenticationMode::ECS->value        => UserAuthenticationMode::ECS->value,
            InternalUserAuthenticationMode::LDAP->value       => UserAuthenticationMode::LDAP->value,
            InternalUserAuthenticationMode::LOCAL->value      => UserAuthenticationMode::LOCAL->value,
            InternalUserAuthenticationMode::LTI->value        => UserAuthenticationMode::LTI->value,
            InternalUserAuthenticationMode::OIDC->value       => UserAuthenticationMode::OPEN_ID_CONNECT->value,
            InternalUserAuthenticationMode::RADIUS->value     => UserAuthenticationMode::RADIUS->value,
            InternalUserAuthenticationMode::SAML->value       => UserAuthenticationMode::SAML->value,
            InternalUserAuthenticationMode::SCRIPT->value     => UserAuthenticationMode::SCRIPT->value,
            InternalUserAuthenticationMode::SHIBBOLETH->value => UserAuthenticationMode::SHIBBOLETH->value,
            InternalUserAuthenticationMode::SOAP->value       => UserAuthenticationMode::SOAP->value
        ];
    }
}
