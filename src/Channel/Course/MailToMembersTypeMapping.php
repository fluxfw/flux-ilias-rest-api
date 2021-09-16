<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Course;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\MailToMembersType;

final class MailToMembersTypeMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalMailToMembersType::ALL                       => MailToMembersType::ALL,
            InternalMailToMembersType::TUTORS_AND_ADMINISTRATORS => MailToMembersType::TUTORS_AND_ADMINISTRATORS
        ];


    public static function mapExternalToInternal(?string $mail_to_members_type) : int
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$mail_to_members_type = $mail_to_members_type ?: MailToMembersType::ALL] ?? substr($mail_to_members_type, 1);
    }


    public static function mapInternalToExternal(?int $mail_to_members_type) : string
    {
        return static::INTERNAL_EXTERNAL[$mail_to_members_type = $mail_to_members_type ?: InternalMailToMembersType::ALL] ?? "_" . $mail_to_members_type;
    }
}
