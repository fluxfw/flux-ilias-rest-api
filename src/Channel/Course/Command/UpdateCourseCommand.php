<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Course\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;

class UpdateCourseCommand
{

    use CourseQuery;

    private CourseService $course;


    public static function new(CourseService $course) : /*static*/ self
    {
        $command = new static();

        $command->course = $course;

        return $command;
    }


    public function updateCourseById(int $id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course->getCourseById(
                $id
            ),
            $diff
        );
    }


    public function updateCourseByImportId(string $import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course->getCourseByImportId(
                $import_id
            ),
            $diff
        );
    }


    public function updateCourseByRefId(int $ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->updateCourse(
            $this->course->getCourseByRefId(
                $ref_id
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
