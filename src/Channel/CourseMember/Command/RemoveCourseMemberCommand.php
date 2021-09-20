<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use ilDBInterface;

class RemoveCourseMemberCommand
{

    use CourseQuery;

    private CourseMemberService $course_member;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, CourseMemberService $course_member) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->course_member = $course_member;

        return $command;
    }


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByIdByUserId(
                $id,
                $user_id
            )
        );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            )
        );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            )
        );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberIdDto
    {
        return $this->removeCourseMember(
            $this->course_member->getCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            )
        );
    }


    private function removeCourseMember(?MemberDto $course_member) : ?MemberIdDto
    {
        if ($course_member === null) {
            return null;
        }

        $ilias_course = $this->getIliasCourse(
            $course_member->getCourseRefId()
        );
        if ($ilias_course === null) {
            return null;
        }

        if (!$ilias_course->getMembersObject()->isAssigned($course_member->getUserId())) {
            return null;
        }

        $ilias_course->getMembersObject()->delete($course_member->getUserId());

        return MemberIdDto::new(
            $course_member->getCourseId(),
            $course_member->getCourseImportId(),
            $course_member->getCourseRefId(),
            $course_member->getUserId(),
            $course_member->getUserImportId()
        );
    }
}
