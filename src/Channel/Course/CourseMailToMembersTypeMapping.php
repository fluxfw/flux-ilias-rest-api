<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Course;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseMailToMembersType;

final class CourseMailToMembersTypeMapping
{

    private const INTERNAL_EXTERNAL
        = [
            InternalCourseMailToMembersType::ALL                       => CourseMailToMembersType::ALL,
            InternalCourseMailToMembersType::TUTORS_AND_ADMINISTRATORS => CourseMailToMembersType::TUTORS_AND_ADMINISTRATORS
        ];


    public static function mapExternalToInternal(?string $mail_to_members_type) : int
    {
        return array_flip(static::INTERNAL_EXTERNAL)[$mail_to_members_type = $mail_to_members_type ?: CourseMailToMembersType::ALL] ?? substr($mail_to_members_type, 1);
    }


    public static function mapInternalToExternal(?int $mail_to_members_type) : string
    {
        return static::INTERNAL_EXTERNAL[$mail_to_members_type = $mail_to_members_type ?: InternalCourseMailToMembersType::ALL] ?? "_" . $mail_to_members_type;
    }
}
