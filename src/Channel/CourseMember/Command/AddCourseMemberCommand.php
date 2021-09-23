<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Exception;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class AddCourseMemberCommand
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


    public function addCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
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


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
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


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
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


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
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


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
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


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
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


    private function addCourseMember(?CourseDto $course, ?UserDto $user, MemberDiffDto $diff) : ?MemberIdDto
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

        if ($ilias_course->getMembersObject()->isAssigned($user->getId())) {
            throw new Exception("Member is already assigned");
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
