<?php

namespace FluxIliasRestApi\Service\CourseMember\Command;

use FluxIliasBaseApi\Adapter\Course\CourseDto;
use FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasBaseApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Course\CourseQuery;
use FluxIliasRestApi\Service\Course\Port\CourseService;
use FluxIliasRestApi\Service\CourseMember\CourseMemberQuery;
use FluxIliasRestApi\Service\User\Port\UserService;

class AddCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private function __construct(
        private readonly CourseService $course_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        CourseService $course_service,
        UserService $user_service
    ) : static {
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
            $course->id,
            $course->ref_id
        );
        if ($ilias_course === null) {
            return null;
        }

        if (!$ilias_course->getMembersObject()->isAssigned($user->id)) {
            $this->mapCourseMemberDiff(
                $diff,
                $user->id,
                $ilias_course
            );
        }

        return CourseMemberIdDto::new(
            $course->id,
            $course->import_id,
            $course->ref_id,
            $user->id,
            $user->import_id
        );
    }
}
