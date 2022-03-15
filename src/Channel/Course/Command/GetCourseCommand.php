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

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function getCourseById(int $id, ?bool $in_trash = null) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getCourseQuery(
                $id,
                null,
                null,
                $in_trash
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the id " . $id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }


    public function getCourseByImportId(string $import_id, ?bool $in_trash = null) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getCourseQuery(
                null,
                $import_id,
                null,
                $in_trash
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the import id " . $import_id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }


    public function getCourseByRefId(int $ref_id, ?bool $in_trash = null) : ?CourseDto
    {
        $course = null;
        while (($course_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getCourseQuery(
                null,
                null,
                $ref_id,
                $in_trash
            )))) !== null) {
            if ($course !== null) {
                throw new LogicException("Multiple courses found with the ref id " . $ref_id);
            }
            $course = $this->mapCourseDto(
                $course_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]])))
            );
        }

        return $course;
    }
}
