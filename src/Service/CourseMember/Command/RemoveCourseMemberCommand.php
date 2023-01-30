<?php

namespace FluxIliasRestApi\Service\CourseMember\Command;

use FluxIliasBaseApi\Adapter\Course\CourseDto;
use FluxIliasBaseApi\Adapter\CourseMember\CourseMemberIdDto;
use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Course\CourseQuery;
use FluxIliasRestApi\Service\Course\Port\CourseService;
use FluxIliasRestApi\Service\User\Port\UserService;

class RemoveCourseMemberCommand
{

    use CourseQuery;

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


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?CourseMemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $this->user_service->getUserByImportId(
                $user_import_id
            )
        );
    }


    private function removeCourseMember(?CourseDto $course, ?UserDto $user) : ?CourseMemberIdDto
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

        if ($ilias_course->getMembersObject()->isAssigned($user->id)) {
            $ilias_course->getMembersObject()->delete($user->id);
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
