<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class RemoveCourseMemberCommand
{

    use CourseQuery;

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


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseById(
                $id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserById(
                $user_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course->getCourseByRefId(
                $ref_id
            ),
            $this->user->getUserByImportId(
                $user_import_id
            )
        );
    }


    private function removeCourseMember(?CourseDto $course, ?UserDto $user) : ?MemberIdDto
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
            $ilias_course->getMembersObject()->delete($user->getId());
        }

        return MemberIdDto::new(
            $course->getId(),
            $course->getImportId(),
            $course->getRefId(),
            $user->getId(),
            $user->getImportId()
        );
    }
}
