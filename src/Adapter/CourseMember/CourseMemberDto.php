<?php

namespace FluxIliasRestApi\Adapter\CourseMember;

use FluxIliasRestApi\Adapter\ObjectLearningProgress\LegacyObjectLearningProgress;
use JsonSerializable;

class CourseMemberDto implements JsonSerializable
{

    private ?bool $access_refused;
    private ?bool $administrator_role;
    private ?int $course_id;
    private ?string $course_import_id;
    private ?int $course_ref_id;
    private ?LegacyObjectLearningProgress $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $passed;
    private ?bool $tutor_role;
    private ?bool $tutorial_support;
    private ?int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $course_id,
        /*public readonly*/ ?string $course_import_id,
        /*public readonly*/ ?int $course_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $tutor_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $passed,
        /*public readonly*/ ?bool $access_refused,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
        $this->course_id = $course_id;
        $this->course_import_id = $course_import_id;
        $this->course_ref_id = $course_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->member_role = $member_role;
        $this->tutor_role = $tutor_role;
        $this->administrator_role = $administrator_role;
        $this->learning_progress = $learning_progress;
        $this->passed = $passed;
        $this->access_refused = $access_refused;
        $this->tutorial_support = $tutorial_support;
        $this->notification = $notification;
    }


    public static function new(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?LegacyObjectLearningProgress $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        return new static(
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


    public function getLearningProgress() : ?LegacyObjectLearningProgress
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
