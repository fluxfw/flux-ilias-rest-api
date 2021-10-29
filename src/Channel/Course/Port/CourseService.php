<?php

namespace FluxIliasRestApi\Channel\Course\Port;

use FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Adapter\Api\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Course\Command\CreateCourseCommand;
use FluxIliasRestApi\Channel\Course\Command\GetCourseCommand;
use FluxIliasRestApi\Channel\Course\Command\GetCoursesCommand;
use FluxIliasRestApi\Channel\Course\Command\UpdateCourseCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class CourseService
{

    private ilDBInterface $database;
    private ObjectService $object;


    public static function new(ilDBInterface $database, ObjectService $object) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->object = $object;

        return $service;
    }


    public function createCourseToId(int $parent_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object
        )
            ->createCourseToId(
                $parent_id,
                $diff
            );
    }


    public function createCourseToImportId(string $parent_import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object
        )
            ->createCourseToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCourseToRefId(int $parent_ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object
        )
            ->createCourseToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getCourseById(int $id) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->database
        )
            ->getCourseById(
                $id
            );
    }


    public function getCourseByImportId(string $import_id) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->database
        )
            ->getCourseByImportId(
                $import_id
            );
    }


    public function getCourseByRefId(int $ref_id) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->database
        )
            ->getCourseByRefId(
                $ref_id
            );
    }


    public function getCourses(bool $container_settings = false) : array
    {
        return GetCoursesCommand::new(
            $this->database
        )
            ->getCourses(
                $container_settings
            );
    }


    public function updateCourseById(int $id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this
        )
            ->updateCourseById(
                $id,
                $diff
            );
    }


    public function updateCourseByImportId(string $import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this
        )
            ->updateCourseByImportId(
                $import_id,
                $diff
            );
    }


    public function updateCourseByRefId(int $ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return UpdateCourseCommand::new(
            $this
        )
            ->updateCourseByRefId(
                $ref_id,
                $diff
            );
    }
}
