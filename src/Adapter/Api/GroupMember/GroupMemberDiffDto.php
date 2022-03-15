<?php

namespace FluxIliasRestApi\Adapter\Api\GroupMember;

use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;

class GroupMemberDiffDto
{

    private ?bool $administrator_role;
    private ?LegacyObjectLearningProgress $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $tutorial_support;


    private function __construct(
        /*public readonly*/ ?bool $member_role,
        /*public readonly*/ ?bool $administrator_role,
        /*public readonly*/ ?LegacyObjectLearningProgress $learning_progress,
        /*public readonly*/ ?bool $tutorial_support,
        /*public readonly*/ ?bool $notification
    ) {
        $this->member_role = $member_role;
        $this->administrator_role = $administrator_role;
        $this->learning_progress = $learning_progress;
        $this->tutorial_support = $tutorial_support;
        $this->notification = $notification;
    }


    public static function new(
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?LegacyObjectLearningProgress $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        return new static(
            $member_role,
            $administrator_role,
            $learning_progress,
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
            $data->administrator_role ?? null,
            ($learning_progress = $data->learning_progress ?? null) !== null ? LegacyObjectLearningProgress::from($learning_progress) : null,
            $data->tutorial_support ?? null,
            $data->notification ?? null
        );
    }


    public function getLearningProgress() : ?LegacyObjectLearningProgress
    {
        return $this->learning_progress;
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


    public function isTutorialSupport() : ?bool
    {
        return $this->tutorial_support;
    }
}
