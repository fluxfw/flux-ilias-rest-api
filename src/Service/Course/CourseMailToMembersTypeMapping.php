<?php

namespace FluxIliasRestApi\Service\Course;

use FluxIliasBaseApi\Adapter\Course\CourseMailToMembersType;

class CourseMailToMembersTypeMapping
{

    public static function mapExternalToInternal(CourseMailToMembersType $mail_to_members_type) : InternalCourseMailToMembersType
    {
        return InternalCourseMailToMembersType::from(array_flip(static::INTERNAL_EXTERNAL())[$mail_to_members_type->value] ?? substr($mail_to_members_type->value, 1));
    }


    public static function mapInternalToExternal(InternalCourseMailToMembersType $mail_to_members_type) : CourseMailToMembersType
    {
        return CourseMailToMembersType::from(static::INTERNAL_EXTERNAL()[$mail_to_members_type->value] ?? "_" . $mail_to_members_type->value);
    }


    private static function INTERNAL_EXTERNAL() : array
    {
        return [
            InternalCourseMailToMembersType::ALL->value                       => CourseMailToMembersType::ALL->value,
            InternalCourseMailToMembersType::TUTORS_AND_ADMINISTRATORS->value => CourseMailToMembersType::TUTORS_AND_ADMINISTRATORS->value
        ];
    }
}
