<?php

namespace FluxIliasRestApi\Channel\Course;

use FluxIliasRestApi\Adapter\Course\LegacyCourseMailToMembersType;

class CourseMailToMembersTypeMapping
{

    public static function mapExternalToInternal(LegacyCourseMailToMembersType $mail_to_members_type) : LegacyInternalCourseMailToMembersType
    {
        return LegacyInternalCourseMailToMembersType::from(array_flip(static::INTERNAL_EXTERNAL())[$mail_to_members_type->value] ?? substr($mail_to_members_type->value, 1));
    }


    public static function mapInternalToExternal(LegacyInternalCourseMailToMembersType $mail_to_members_type) : LegacyCourseMailToMembersType
    {
        return LegacyCourseMailToMembersType::from(static::INTERNAL_EXTERNAL()[$mail_to_members_type->value] ?? "_" . $mail_to_members_type->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            LegacyInternalCourseMailToMembersType::ALL()->value                       => LegacyCourseMailToMembersType::ALL()->value,
            LegacyInternalCourseMailToMembersType::TUTORS_AND_ADMINISTRATORS()->value => LegacyCourseMailToMembersType::TUTORS_AND_ADMINISTRATORS()->value
        ];
    }
}
