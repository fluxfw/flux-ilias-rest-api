<?php

namespace FluxIliasRestApi\Adapter\CourseMember;

use JsonSerializable;

class CourseMemberIdDto implements JsonSerializable
{

    private ?int $course_id;
    private ?string $course_import_id;
    private ?int $course_ref_id;
    private ?int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $course_id,
        /*public readonly*/ ?string $course_import_id,
        /*public readonly*/ ?int $course_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id
    ) {
        $this->course_id = $course_id;
        $this->course_import_id = $course_import_id;
        $this->course_ref_id = $course_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
    }


    public static function new(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : /*static*/ self
    {
        return new static(
            $course_id,
            $course_import_id,
            $course_ref_id,
            $user_id,
            $user_import_id
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


    public function getUserId() : ?int
    {
        return $this->user_id;
    }


    public function getUserImportId() : ?string
    {
        return $this->user_import_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
