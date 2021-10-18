<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember;

use JsonSerializable;

class CourseMemberDto implements JsonSerializable
{

    private ?bool $access_refused;
    private ?bool $administrator_role;
    private ?int $course_id;
    private ?string $course_import_id;
    private ?int $course_ref_id;
    private ?string $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $passed;
    private ?bool $tutor_role;
    private ?bool $tutorial_support;
    private ?int $user_id;
    private ?string $user_import_id;


    public static function new(
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
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->course_id = $course_id;
        $dto->course_import_id = $course_import_id;
        $dto->course_ref_id = $course_ref_id;
        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;
        $dto->member_role = $member_role;
        $dto->tutor_role = $tutor_role;
        $dto->administrator_role = $administrator_role;
        $dto->learning_progress = $learning_progress;
        $dto->passed = $passed;
        $dto->access_refused = $access_refused;
        $dto->tutorial_support = $tutorial_support;
        $dto->notification = $notification;

        return $dto;
    }


    public function getCourseId() : ?int
    {
        return $this->course_id;
    }


    public function getCourseImportId() : ?string
    {
        return $this->course_import_id;
    }


    public function getCourseRefId() : ?int
    {
        return $this->course_ref_id;
    }


    public function getLearningProgress() : ?string
    {
        return $this->learning_progress;
    }


    public function getUserId() : ?int
    {
        return $this->user_id;
    }


    public function getUserImportId() : ?string
    {
        return $this->user_import_id;
    }


    public function isAccessRefused() : ?bool
    {
        return $this->access_refused;
    }


    public function isAdministratorRole() : ?bool
    {
        return $this->administrator_role;
    }


    public function isMemberRole() : ?bool
    {
        return $this->member_role;
    }


    public function isNotification() : ?bool
    {
        return $this->notification;
    }


    public function isPassed() : ?bool
    {
        return $this->passed;
    }


    public function isTutorRole() : ?bool
    {
        return $this->tutor_role;
    }


    public function isTutorialSupport() : ?bool
    {
        return $this->tutorial_support;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
