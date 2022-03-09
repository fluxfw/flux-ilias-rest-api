<?php

namespace FluxIliasRestApi\Adapter\Api\CourseMember;

use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;

class CourseMemberDiffDto
{

    private ?bool $access_refused;
    private ?bool $administrator_role;
    private ?LegacyObjectLearningProgress $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $passed;
    private ?bool $tutor_role;
    private ?bool $tutorial_support;


    private function __construct(
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $tutor_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $passed,
        /*public readonly*/ ?bool $access_refused,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
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


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->member_role ?? null,
            $data->tutor_role ?? null,
            $data->administrator_role ?? null,
            ($learning_progress = $data->learning_progress ?? null) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null,
            $data->passed ?? null,
            $data->access_refused ?? null,
            $data->tutorial_support ?? null,
            $data->notification ?? null
        );
    }


    public function getLearningProgress() : ?LegacyObjectLearningProgress
    {
        return $this->learning_progress;
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
}
