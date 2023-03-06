<?php

namespace FluxIliasRestApi\Adapter\CourseMember;

class CourseMemberIdDto
{

    private function __construct(
        public readonly ?int $course_id,
        public readonly ?string $course_import_id,
        public readonly ?int $course_ref_id,
        public readonly ?int $user_id,
        public readonly ?string $user_import_id
    ) {

    }


    public static function new(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : static {
        return new static(
            $course_id,
            $course_import_id,
            $course_ref_id,
            $user_id,
            $user_import_id
        );
    }


    public static function newFromObject(
        object $id
    ) : static {
        return static::new(
            $id->course_id ?? null,
            $id->course_import_id ?? null,
            $id->course_ref_id ?? null,
            $id->user_id ?? null,
            $id->user_import_id ?? null
        );
    }
}
