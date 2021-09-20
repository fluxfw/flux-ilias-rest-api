<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Course\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Channel\Course\CourseQuery;
use ilDBInterface;

class GetCoursesCommand
{

    use CourseQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getCourses(bool $container_settings = false) : array
    {
        $courses = $this->database->fetchAll($this->database->query($this->getCourseQuery()));
        $course_ids = array_map(fn(array $course) : int => $course["obj_id"], $courses);

        $container_settings_ = $container_settings ? $this->database->fetchAll($this->database->query($this->getContainerSettingQuery($course_ids))) : null;

        return array_map(fn(array $course) : CourseDto => $this->mapCourseDto(
            $course,
            $container_settings_
        ), $courses);
    }
}
