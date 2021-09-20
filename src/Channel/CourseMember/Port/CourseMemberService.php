<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\AddCourseMemberCommand;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command\GetCourseMemberCommand;
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
            $this->database,
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
            $this->database,
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
            $this->database,
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
            $this->database,
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
            $this->database,
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
            $this->database,
            $this->course,
            $this->user
        )
            ->addCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }


    public function getCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function getCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function getCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function getCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function getCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function getCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberDto
    {
        return GetCourseMemberCommand::new(
            $this->database,
            $this->course,
            $this->user
        )
            ->getCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function getCourseMembersById(int $id) : ?array
    {
        return GetCourseMembersCommand::new(
            $this->database,
            $this->course
        )
            ->getCourseMembersById(
                $id
            );
    }


    public function getCourseMembersByImportId(string $import_id) : ?array
    {
        return GetCourseMembersCommand::new(
            $this->database,
            $this->course
        )
            ->getCourseMembersByImportId(
                $import_id
            );
    }


    public function getCourseMembersByRefId(int $ref_id) : ?array
    {
        return GetCourseMembersCommand::new(
            $this->database,
            $this->course
        )
            ->getCourseMembersByRefId(
                $ref_id
            );
    }


    public function removeCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByIdByUserId(
                $id,
                $user_id
            );
    }


    public function removeCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByIdByUserImportId(
                $id,
                $user_import_id
            );
    }


    public function removeCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByImportIdByUserId(
                $import_id,
                $user_id
            );
    }


    public function removeCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByImportIdByUserImportId(
                $import_id,
                $user_import_id
            );
    }


    public function removeCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByRefIdByUserId(
                $ref_id,
                $user_id
            );
    }


    public function removeCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberIdDto
    {
        return RemoveCourseMemberCommand::new(
            $this->database,
            $this
        )
            ->removeCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id
            );
    }


    public function updateCourseMemberByIdByUserId(int $id, int $user_id, MemberDiffDto $diff) : ?MemberIdDto
    {
        return UpdateCourseMemberCommand::new(
            $this->database,
            $this
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
            $this->database,
            $this
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
            $this->database,
            $this
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
            $this->database,
            $this
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
            $this->database,
            $this
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
            $this->database,
            $this
        )
            ->updateCourseMemberByRefIdByUserImportId(
                $ref_id,
                $user_import_id,
                $diff
            );
    }
}
