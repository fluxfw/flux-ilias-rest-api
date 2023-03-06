<?php

namespace FluxIliasRestApi\Adapter\CourseMember;

use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;

class CourseMemberDiffDto
{

    private function __construct(
        public readonly ?bool $member_role,
        public readonly ?bool $tutor_role,
        public readonly ?bool $administrator_role,
        public readonly ?ObjectLearningProgress $learning_progress,
        public readonly ?bool $passed,
        public readonly ?bool $access_refused,
        public readonly ?bool $tutorial_support,
        public readonly ?bool $notification
    ) {

    }


    public static function new(
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?ObjectLearningProgress $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : static {
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


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->member_role ?? null,
            $diff->tutor_role ?? null,
            $diff->administrator_role ?? null,
            ($learning_progress = $diff->learning_progress ?? null) !== null ? ObjectLearningProgress::from($learning_progress) : null,
            $diff->passed ?? null,
            $diff->access_refused ?? null,
            $diff->tutorial_support ?? null,
            $diff->notification ?? null
        );
    }
}
