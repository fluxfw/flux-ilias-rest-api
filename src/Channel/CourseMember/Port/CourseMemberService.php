<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\AddCourseMemberCommand;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\GetCourseMembersCommand;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\RemoveCourseMemberCommand;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\UpdateCourseMemberCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;

class CourseMemberService
{

    private CourseService $course;
    private ilDBInterface $database;
    private UserService $user;


    public static function new(ilDBInterface $database, CourseService $course, UserService $user) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->course = $course;
        $service->user = $user;

        return $service;
    }


    public function addCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function addCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return AddCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->addCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    public function getCourseMembers(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?string $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return GetCourseMembersCommand::new(
            $this->database
        )
            ->getCourseMembers(
                $course_id,
                $course_import_id,
                $course_ref_id,
                $user_id,
                $user_import_id,
                $member_role,
                $tutor_role,
                $administrator_role,
                $learning_progress,
                $passed,
                $access_refused,
                $tutorial_support,
                $notification
            );
    }


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->removeCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByIdByUserId(
                $id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByIdByUserImportId(int $id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByIdByUserImportId(
                $id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserId(string $import_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByImportIdByUserId(
                $import_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserId(int $ref_id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id,
                $diff
            );
    }


    public function updateCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->course,
            $this->user
        )
            ->updateCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }
}
