<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember;

class MemberDiffDto
{

    private ?bool $access_refused;
    private ?bool $administrator_role;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $passed;
    private ?bool $tutor_role;
    private ?bool $tutorial_support;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->member_role ?? null,
            $data->tutor_role ?? null,
            $data->administrator_role ?? null,
            $data->passed ?? null,
            $data->access_refused ?? null,
            $data->tutorial_support ?? null,
            $data->notification ?? null
        );
    }


    private static function new(
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->member_role = $member_role;
        $dto->tutor_role = $tutor_role;
        $dto->administrator_role = $administrator_role;
        $dto->passed = $passed;
        $dto->access_refused = $access_refused;
        $dto->tutorial_support = $tutorial_support;
        $dto->notification = $notification;

        return $dto;
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
