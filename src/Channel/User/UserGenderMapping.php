<?php

namespace FluxIliasRestApi\Channel\User;

use FluxIliasRestApi\Adapter\Api\User\LegacyUserGender;

final class UserGenderMapping
{

    public static function mapExternalToInternal(LegacyUserGender $gender) : LegacyInternalUserGender
    {
        return LegacyInternalUserGender::from(array_flip(static::INTERNAL_EXTERNAL())[$gender->value] ?? substr($gender->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalUserGender $gender) : LegacyUserGender
    {
        return LegacyUserGender::from(static::INTERNAL_EXTERNAL()[$gender->value] ?? "_" . $gender->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalUserGender::F()->value => LegacyUserGender::FEMALE()->value,
            LegacyInternalUserGender::M()->value => LegacyUserGender::MALE()->value,
            LegacyInternalUserGender::N()->value => LegacyUserGender::NONE()->value
        ];
    }
}
