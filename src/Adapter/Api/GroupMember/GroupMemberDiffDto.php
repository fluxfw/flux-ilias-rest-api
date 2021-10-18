<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\GroupMember;

class GroupMemberDiffDto
{

    private ?bool $administrator_role;
    private ?string $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $tutorial_support;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->member_role ?? null,
            $data->administrator_role ?? null,
            $data->learning_progress ?? null,
            $data->tutorial_support ?? null,
            $data->notification ?? null
        );
    }


    private static function new(
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?string $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->member_role = $member_role;
        $dto->administrator_role = $administrator_role;
        $dto->learning_progress = $learning_progress;
        $dto->tutorial_support = $tutorial_support;
        $dto->notification = $notification;

        return $dto;
    }


    public function getLearningProgress() : ?string
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
