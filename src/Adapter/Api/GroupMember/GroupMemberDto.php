<?php

namespace FluxIliasRestApi\Adapter\Api\GroupMember;

use FluxIliasRestApi\Adapter\Api\ObjectLearningProgress\LegacyObjectLearningProgress;
use JsonSerializable;

class GroupMemberDto implements JsonSerializable
{

    private ?bool $administrator_role;
    private ?int $group_id;
    private ?string $group_import_id;
    private ?int $group_ref_id;
    private ?LegacyObjectLearningProgress $learning_progress;
    private ?bool $member_role;
    private ?bool $notification;
    private ?bool $tutorial_support;
    private ?int $user_id;
    private ?string $user_import_id;


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?LegacyObjectLearningProgress $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->group_id = $group_id;
        $dto->group_import_id = $group_import_id;
        $dto->group_ref_id = $group_ref_id;
        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;
        $dto->member_role = $member_role;
        $dto->administrator_role = $administrator_role;
        $dto->learning_progress = $learning_progress;
        $dto->tutorial_support = $tutorial_support;
        $dto->notification = $notification;

        return $dto;
    }


    public function getGroupId() : ?int
    {
        return $this->group_id;
    }


    public function getGroupImportId() : ?string
    {
        return $this->group_import_id;
    }


    public function getGroupRefId() : ?int
    {
        return $this->group_ref_id;
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


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
