<?php

namespace FluxIliasRestApi\Service\User;

use FluxIliasRestApi\Adapter\User\UserGender;

class UserGenderMapping
{

    public static function mapExternalToInternal(UserGender $gender) : InternalUserGender
    {
        return InternalUserGender::from(array_flip(static::INTERNAL_EXTERNAL())[$gender->value] ?? substr($gender->value, 1));
    }


    public static function mapInternalToExternal(InternalUserGender $gender) : UserGender
    {
        return UserGender::from(static::INTERNAL_EXTERNAL()[$gender->value] ?? "_" . $gender->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalUserGender::F->value => UserGender::FEMALE->value,
            InternalUserGender::M->value => UserGender::MALE->value,
            InternalUserGender::N->value => UserGender::NONE->value
        ];
    }
}
