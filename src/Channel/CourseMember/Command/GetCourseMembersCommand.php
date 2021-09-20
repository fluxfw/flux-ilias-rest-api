<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember\Command;

use Fluxlabs\FluxIliasRestApi\Channel\Course\Port\CourseService;
use Fluxlabs\FluxIliasRestApi\Channel\CourseMember\CourseMemberQuery;
use ilDBInterface;

class GetCourseMembersCommand
{

    use CourseMemberQuery;

    private CourseService $course;
    private ilDBInterface $database;


    public static function new(ilDBInterface $database, CourseService $course) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->course = $course;

        return $command;
    }


    public function getCourseMembersById(int $id) : ?array
    {
        $course = $this->course->getCourseById(
            $id
        );

        if ($course === null) {
            return null;
        }

        return array_map([$this, "mapCourseMemberDto"], $this->database->fetchAll($this->database->query($this->getCourseMemberQuery(
            $course->getId()
        ))));
    }


    public function getCourseMembersByImportId(string $import_id) : ?array
    {
        $course = $this->course->getCourseByImportId(
            $import_id
        );

        if ($course === null) {
            return null;
        }

        return array_map([$this, "mapCourseMemberDto"], $this->database->fetchAll($this->database->query($this->getCourseMemberQuery(
            null,
            $course->getImportId()
        ))));
    }


    public function getCourseMembersByRefId(int $ref_id) : ?array
    {
        $course = $this->course->getCourseByRefId(
            $ref_id
        );

        if ($course === null) {
            return null;
        }

        return array_map([$this, "mapCourseMemberDto"], $this->database->fetchAll($this->database->query($this->getCourseMemberQuery(
            null,
            null,
            $course->getRefId()
        ))));
    }
}
