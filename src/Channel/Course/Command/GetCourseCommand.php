<?php

namespace FluxIliasRestApi\Channel\Course\Command;

use FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use FluxIliasRestApi\Channel\Course\CourseQuery;
use FluxIliasRestApi\Channel\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetCourseCommand
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


    public function getCourseById(int $id) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseQuery(
                $id
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the id " . $id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->database->fetchAll($this->database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }


    public function getCourseByImportId(string $import_id) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseQuery(
                null,
                $import_id
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the import id " . $import_id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->database->fetchAll($this->database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }


    public function getCourseByRefId(int $ref_id) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getCourseQuery(
                null,
                null,
                $ref_id
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the ref id " . $ref_id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->database->fetchAll($this->database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }
}
