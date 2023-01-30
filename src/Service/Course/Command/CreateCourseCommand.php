<?php

namespace FluxIliasRestApi\Service\Course\Command;

use FluxIliasBaseApi\Adapter\Course\CourseDiffDto;
use FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasBaseApi\Adapter\Object\ObjectIdDto;
use FluxIliasRestApi\Service\Course\CourseQuery;
use FluxIliasRestApi\Service\CustomMetadata\CustomMetadataQuery;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use ilDBInterface;

class CreateCourseCommand
{

    use CourseQuery;
    use CustomMetadataQuery;

    private function __construct(
        private readonly ObjectService $object_service,
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ObjectService $object_service,
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $object_service,
            $ilias_database
        );
    }


    public function createCourseToId(int $parent_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCourse(
            $this->object_service->getObjectById(
                $parent_id,
                false
            ),
            $diff
        );
    }


    public function createCourseToImportId(string $parent_import_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCourse(
            $this->object_service->getObjectByImportId(
                $parent_import_id,
                false
            ),
            $diff
        );
    }


    public function createCourseToRefId(int $parent_ref_id, CourseDiffDto $diff) : ?ObjectIdDto
    {
        return $this->createCourse(
            $this->object_service->getObjectByRefId(
                $parent_ref_id,
                false
            ),
            $diff
        );
    }


    private function createCourse(?ObjectDto $parent_object, CourseDiffDto $diff) : ?ObjectIdDto
    {
        if ($parent_object === null || $parent_object->ref_id === null) {
            return null;
        }

        $ilias_course = $this->newIliasCourse();

        $ilias_course->setTitle($diff->title ?? "");

        $ilias_course->create();
        $ilias_course->createReference();
        $ilias_course->putInTree($parent_object->ref_id);
        $ilias_course->setPermissions($parent_object->ref_id);

        $this->mapCourseDiff(
            $diff,
            $ilias_course
        );

        $ilias_course->update();

        return ObjectIdDto::new(
            $ilias_course->getId() ?: null,
            $diff->import_id,
            $ilias_course->getRefId() ?: null
        );
    }
}
