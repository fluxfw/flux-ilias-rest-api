<?php

namespace FluxIliasRestApi\Adapter\Course;

enum CourseMailToMembersType: string
{

    case ALL = "all";
    case TUTORS_AND_ADMINISTRATORS = "tutors_and_administrators";
}
