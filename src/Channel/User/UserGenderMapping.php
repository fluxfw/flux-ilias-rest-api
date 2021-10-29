<?php

namespace FluxIliasRestApi\Channel\User;

use FluxIliasRestApi\Adapter\Api\User\UserGender;

final class UserGenderMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalUserGender::F => UserGender::FEMALE,
            InternalUserGender::M => UserGender::MALE,
            InternalUserGender::N => UserGender::NONE
        ];


    public static function mapExternalToInternal(?string $gender) : string
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$gender = $gender ?: UserGender::NONE] ?? substr($gender, 1);
    }


    public static function mapInternalToExternal(?string $gender) : string
    {
        return static::INTERNAL_EXTERNAL[$gender = $gender ?: InternalUserGender::N] ?? "_" . $gender;
    }
}
