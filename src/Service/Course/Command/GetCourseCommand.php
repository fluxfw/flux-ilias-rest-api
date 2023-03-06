<?php

namespace FluxIliasRestApi\Service\Course\Command;

use FluxIliasRestApi\Adapter\Course\CourseDto;
use FluxIliasRestApi\Service\Course\CourseQuery;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Object\ObjectQuery;
use ilDBInterface;
use LogicException;

class GetCourseCommand
{

    use CourseQuery;
    use CustomMetadataQuery;
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
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]]))),
                true
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
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]]))),
                true
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
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseContainerSettingQuery([$course_["obj_id"]]))),
                true
            );
        }

        return $course;
    }
}
