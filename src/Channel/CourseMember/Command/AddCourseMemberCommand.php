<?php

namespace FluxIliasRestApi\Channel\CourseMember\Command;

use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberIdDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\Course\CourseQuery;
use FluxIliasRestApi\Channel\Course\Port\CourseService;
use FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use FluxIliasRestApi\Channel\User\Port\UserService;

class AddCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private CourseService $course;
    private UserService $user;


    public static function new(CourseService $course, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->course = $course;
        $command->user = $user;

        return $command;
    }


    public function addCourseMemberByIdByUserId(int $id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, CourseMemberDiffDto $diff) : ?CourseMemberIdDto
    {
        return $this->addCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
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
