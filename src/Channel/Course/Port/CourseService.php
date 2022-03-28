<?php

namespace FluxIliasRestApi\Channel\Course\Port;

use FluxIliasRestApi\Adapter\Course\CourseDiffDto;
use FluxIliasRestApi\Adapter\Course\CourseDto;
use FluxIliasRestApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Channel\Course\Command\CreateCourseCommand;
use FluxIliasRestApi\Channel\Course\Command\GetCourseCommand;
use FluxIliasRestApi\Channel\Course\Command\GetCoursesCommand;
use FluxIliasRestApi\Channel\Course\Command\UpdateCourseCommand;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use ilDBInterface;

class CourseService
{

    private ilDBInterface $ilias_database;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->object_service = $object_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ObjectService $object_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $object_service
        );
    }


    public function createCourseToId(int $parent_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service
        )
            ->createCourseToId(
                $parent_id,
                $diff
            );
    }


    public function createCourseToImportId(string $parent_import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service
        )
            ->createCourseToImportId(
                $parent_import_id,
                $diff
            );
    }


    public function createCourseToRefId(int $parent_ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return CreateCourseCommand::new(
            $this->object_service
        )
            ->createCourseToRefId(
                $parent_ref_id,
                $diff
            );
    }


    public function getCourseById(int $id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseById(
                $id,
                $in_trash
            );
    }


    public function getCourseByImportId(string $import_id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseByImportId(
                $import_id,
                $in_trash
            );
    }


    public function getCourseByRefId(int $ref_id, ?bool $in_trash = null) : ?CourseDto
    {
        return GetCourseCommand::new(
            $this->ilias_database
        )
            ->getCourseByRefId(
                $ref_id,
                $in_trash
            );
    }


    public function getCourses(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        return GetCoursesCommand::new(
            $this->ilias_database
        )
            ->getCourses(
                $container_settings,
                $in_trash
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
