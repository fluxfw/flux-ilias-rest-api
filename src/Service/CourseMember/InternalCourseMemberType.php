<?php

namespace FluxIliasRestApi\Service\CourseMember;

enum InternalCourseMemberType: int
{

    case ADMINISTRATOR = 1;
    case MEMBER = 2;
    case TUTOR = 3;
}

// ilCourseConstants::CRS_ADMIN
// ilCourseConstants::CRS_MEMBER
// ilCourseConstants::CRS_TUTOR
