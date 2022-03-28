<?php

namespace FluxIliasRestApi\Channel\CourseMember\Command;

use FluxIliasRestApi\Adapter\Course\CourseDto;
use FluxIliasRestApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Channel\Course\CourseQuery;
use FluxIliasRestApi\Channel\Course\Port\CourseService;
use FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use FluxIliasRestApi\Channel\User\Port\UserService;

class AddCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private CourseService $course_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ CourseService $course_service,
        /*private readonly*/ UserService $user_service
    ) {
        $this->course_service = $course_service;
        $this->user_service = $user_service;
    }


    public static function new(
        CourseService $course_service,
        UserService $user_service
    ) : /*static*/ self
    {
        return new static(
            $course_service,
            $user_service
        );
    }


    public function addCourseMemberByIdByUserId(int $id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    private function addCourseMember(?CourseDto $course, ?UserDto $user, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        if ($course === null || $user === null) {
            return null;
        }

        $ilias_course = $this->getIliasCourse(
            $course->getId(),
            $course->getRefId()
        );
        if ($ilias_course === null) {
            return null;
        }

        if (!$ilias_course->getMembersObject()->isAssigned($user->getId())) {
            $this->mapCourseMemberDiff(
                $diff,
                $user->getId(),
                $ilias_course
            );
        }

        return CourseMemberIdDto::new(
            $course->getId(),
            $course->getImportId(),
            $course->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
