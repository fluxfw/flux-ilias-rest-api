<?php

namespace FluxIliasRestApi\Service\CourseMember\Command;

use FluxIliasRestApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Service\CourseMember\CourseMemberQuery;
use ilDBInterface;

class GetCourseMembersCommand
{

    use CourseMemberQuery;

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
     * @return CourseMemberDto[]
     */
    public function getCourseMembers(
        ?int $course_id = null,
        ?string $course_import_id = null,
        ?int $course_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?bool $member_role = null,
        ?bool $tutor_role = null,
        ?bool $administrator_role = null,
        ?ObjectLearningProgress $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : array {
        return array_map([$this, "mapCourseMemberDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getCourseMemberQuery(
            $course_id,
            $course_import_id,
            $course_ref_id,
            $user_id,
            $user_import_id,
            $member_role,
            $tutor_role,
            $administrator_role,
            $learning_progress,
            $passed,
            $access_refused,
            $tutorial_support,
            $notification
        ))));
    }
}
