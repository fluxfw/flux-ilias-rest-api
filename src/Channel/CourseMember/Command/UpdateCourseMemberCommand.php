<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class UpdateCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private CourseService $course;
    private ilDBInterface $database;
    private UserService $user;


    public static function new(ilDBInterface $database, CourseService $course, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->course = $course;
        $command->user = $user;

        return $command;
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            ),
            $diff
        );
    }


    private function updateCourseMember(?CourseDto $course, ?UserDto $user, MemberDiffDto $diff) : ?MemberIdDto
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
            return null;
        }

        $this->mapCourseMemberDiff(
            $diff,
            $user->getId(),
            $ilias_course
        );

        return MemberIdDto::new(
            $course->getId(),
            $course->getImportId(),
            $course->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
