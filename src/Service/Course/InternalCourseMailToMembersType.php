<?php

namespace FluxIliasRestApi\Service\Course;

enum InternalCourseMailToMembersType: int
{

    case ALL = 1;
    case TUTORS_AND_ADMINISTRATORS = 2;
}

// ilCourseConstants::MAIL_ALLOWED_ALL
// ilCourseConstants::MAIL_ALLOWED_TUTORS
