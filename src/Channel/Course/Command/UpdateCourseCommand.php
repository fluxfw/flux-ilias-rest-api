<?php

namespace FluxIliasRestApi\Channel\Course\Command;

use FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Course\CourseQuery;
use FluxIliasRestApi\Channel\Course\Port\CourseService;

class UpdateCourseCommand
{

    use CourseQuery;

    private CourseService $course_service;


    private function __construct(
        /*private readonly*/ CourseService $course_service
    ) {
        $this->course_service = $course_service;
    }


    public static function new(
        CourseService $course_service
    ) : /*static*/ self
    {
        return new static(
            $course_service
        );
    }


    public function updateCourseById(int $id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course_service->getCourseById(
                $id,
                false
            ),
            $diff
        );
    }


    public function updateCourseByImportId(string $import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course_service->getCourseByImportId(
                $import_id,
                false
            ),
            $diff
        );
    }


    public function updateCourseByRefId(int $ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course_service->getCourseByRefId(
                $ref_id,
                false
            ),
            $diff
        );
    }


    private function updateCourse(?CourseDto $course, CourseDiffDto $diff) : ?ObjectIdDto
    {
        if ($course === null) {
            return null;
        }

        $ilias_course = $this->getIliasCourse(
            $course->getId(),
            $course->getRefId()
        );
        if ($ilias_course === null) {
            return null;
        }

        $this->mapCourseDiff(
            $diff,
            $ilias_course
        );

        $ilias_course->update();

        return ObjectIdDto::new(
            $course->getId(),
            $diff->getImportId() ?? $course->getImportId(),
            $course->getRefId()
        );
    }
}
