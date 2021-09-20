<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\MemberDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilDBInterface;
use LogicException;

class GetCourseMemberCommand
{

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


    public function getCourseMemberByIdByUserId(int $id, int $user_id) : ?MemberDto
    {
        $course = $this->course->getCourseById(
            $id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserById(
            $user_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                $course->getId(),
                null,
                null,
                $user->getId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }


    public function getCourseMemberByIdByUserImportId(int $id, string $user_import_id) : ?MemberDto
    {
        $course = $this->course->getCourseById(
            $id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserByImportId(
            $user_import_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                $course->getId(),
                null,
                null,
                null,
                $user->getImportId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }


    public function getCourseMemberByImportIdByUserId(string $import_id, int $user_id) : ?MemberDto
    {
        $course = $this->course->getCourseByImportId(
            $import_id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserById(
            $user_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                null,
                $course->getImportId(),
                null,
                $user->getId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }


    public function getCourseMemberByImportIdByUserImportId(string $import_id, string $user_import_id) : ?MemberDto
    {
        $course = $this->course->getCourseByImportId(
            $import_id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserByImportId(
            $user_import_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                null,
                $course->getImportId(),
                null,
                null,
                $user->getImportId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }


    public function getCourseMemberByRefIdByUserId(int $ref_id, int $user_id) : ?MemberDto
    {
        $course = $this->course->getCourseByRefId(
            $ref_id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserById(
            $user_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                null,
                null,
                $course->getRefId(),
                $user->getId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }


    public function getCourseMemberByRefIdByUserImportId(int $ref_id, string $user_import_id) : ?MemberDto
    {
        $course = $this->course->getCourseByRefId(
            $ref_id
        );
        if ($course === null) {
            return null;
        }

        $user = $this->user->getUserByImportId(
            $user_import_id
        );
        if ($user === null) {
            return null;
        }

        $course_member = null;
        while (($course_member_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseMemberQuery(
                null,
                null,
                $course->getRefId(),
                null,
                $user->getImportId()
            )))) !== null) {
            if ($course_member !== null) {
                throw new LogicException("Multiple members found");
            }
            $course_member = $this->mapCourseMemberDto(
                $course_member_
            );
        }

        return $course_member;
    }
}
