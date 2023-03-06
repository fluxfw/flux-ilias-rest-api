<?php

namespace FluxIliasRestApi\Adapter\GroupMember;

use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;

class GroupMemberDto
{

    private function __construct(
        public readonly ?int $group_id,
        public readonly ?string $group_import_id,
        public readonly ?int $group_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id,
        public readonly ?bool $member_role,
        public readonly ?bool $administrator_role,
        public readonly ?ObjectLearningProgress $learning_progress,
        public readonly ?bool $tutorial_support,
        public readonly ?bool $notification
    ) {

    }


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $administrator_role = null,
        ?ObjectLearningProgress $learning_progress = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : static {
        return new static(
            $group_id,
            $group_import_id,
            $group_ref_id,
            $user_id,
            $user_import_id,
            $member_role,
            $administrator_role,
            $learning_progress,
            $tutorial_support,
            $notification
        );
    }


    public static function newFromObject(
        object $group_member
    ) : static {
        return static::new(
            $group_member->group_id ?? null,
            $group_member->group_import_id ?? null,
            $group_member->group_ref_id ?? null,
            $group_member->user_id ?? null,
            $group_member->user_import_id ?? null,
            $group_member->member_role ?? null,
            $group_member->administrator_role ?? null,
            ($learning_progress = $group_member->learning_progress ?? null) !== null ? ObjectLearningProgress::from($learning_progress) : null,
            $group_member->tutorial_support ?? null,
            $group_member->notification ?? null
        );
    }
}
