<?php

namespace FluxIliasRestApi\Service\Course\Command;

use FluxIliasBaseApi\Adapter\Course\CourseDto;
use FluxIliasRestApi\Service\Course\CourseQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;

class GetCoursesCommand
{

    use CourseQuery;
    use ObjectQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return CourseDto[]
     */
    public function getCourses(bool $container_settings = false, ?bool $in_trash = null) : array
    {
        $courses = $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseQuery(
            null,
            null,
            null,
            $in_trash
        )));
        $course_ids = array_map(fn(array $course) : int => $course["obj_id"], $courses);

        $container_settings_ = $container_settings ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery($course_ids))) : null;

        return array_map(fn(array $course) : CourseDto => $this->mapCourseDto(
            $course,
            $container_settings_
        ), $courses);
    }
}
