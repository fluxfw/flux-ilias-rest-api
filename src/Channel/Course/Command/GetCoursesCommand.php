<?php

namespace FluxIliasRestApi\Channel\Course\Command;

use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Channel\Course\CourseQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;

class GetCoursesCommand
{

    use CourseQuery;
    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getCourses(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        $courses = $this->database->fetchAll($this->database->query($this->getCourseQuery(
            null,
            null,
            null,
            $in_trash
        )));
        $course_ids = array_map(fn(array $course) : int => $course["obj_id"], $courses);

        $container_settings_ = $container_settings ? $this->database->fetchAll($this->database->query($this->getCourseContainerSettingQuery($course_ids))) : null;

        return array_map(fn(array $course) : CourseDto => $this->mapCourseDto(
            $course,
            $container_settings_
        ), $courses);
    }
}
