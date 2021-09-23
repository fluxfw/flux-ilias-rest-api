<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port\CourseMemberService;
use ilDBInterface;

class UpdateCourseMemberCommand
{

    use CourseQuery;
    use CourseMemberQuery;

    private CourseMemberService $course_member;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, CourseMemberService $course_member) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->course_member = $course_member;

        return $command;
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByIdByUserId(
                $id,
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            ),
            $diff
        );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return $this->updateCourseMember(
            $this->course_member->getCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            ),
            $diff
        );
    }


    private function updateCourseMember(?MemberDto $course_member, MemberDiffDto $diff) : ?MemberIdDto
    {
        if ($course_member === null) {
            return null;
        }

        $ilias_course = $this->getIliasCourse(
            $course_member->getCourseId(),
            $course_member->getCourseRefId()
        );
        if ($ilias_course === null) {
            return null;
        }

        if (!$ilias_course->getMembersObject()->isAssigned($course_member->getUserId())) {
            return null;
        }

        $this->mapCourseMemberDiff(
            $diff,
            $course_member->getUserId(),
            $ilias_course
        );

        return MemberIdDto::new(
            $course_member->getCourseId(),
            $course_member->getCourseImportId(),
            $course_member->getCourseRefId(),
            $course_member->getUserId(),
            $course_member->getUserImportId()
        );
    }
}
