<?php

namespace FluxIliasRestApi\Service\CourseMember;

use FluxIliasRestApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApi\Adapter\ObjectLearningProgress\ObjectLearningProgress;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use FluxIliasRestApi\Service\ObjectLearningProgress\InternalObjectLearningProgress;
use FluxIliasRestApi\Service\ObjectLearningProgress\ObjectLearningProgressMapping;
use ilDBConstants;
use ilLPStatus;
use ilObjCourse;
use LogicException;

trait CourseMemberQuery
{

    private function getCourseMemberQuery(
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
    ) : string {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::CRS->value, ilDBConstants::T_TEXT),
            "object_data_user.type=" . $this->ilias_database->quote(DefaultInternalObjectType::USR->value, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($course_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($course_id, ilDBConstants::T_INTEGER);
        }

        if ($course_import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($course_import_id, ilDBConstants::T_TEXT);
        }

        if ($course_ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($course_ref_id, ilDBConstants::T_INTEGER);
        }

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->ilias_database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->ilias_database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($member_role !== null) {
            $wheres[] = "member=" . $this->ilias_database->quote($member_role, ilDBConstants::T_INTEGER);
        }

        if ($tutor_role !== null) {
            $wheres[] = "tutor=" . $this->ilias_database->quote($tutor_role, ilDBConstants::T_INTEGER);
        }

        if ($administrator_role !== null) {
            $wheres[] = "admin=" . $this->ilias_database->quote($administrator_role, ilDBConstants::T_INTEGER);
        }

        if ($learning_progress !== null) {
            $wheres[] = "status=" . $this->ilias_database->quote(ObjectLearningProgressMapping::mapExternalToInternal($learning_progress)->value, ilDBConstants::T_INTEGER);
        }

        if ($passed !== null) {
            $wheres[] = "passed=" . $this->ilias_database->quote($passed, ilDBConstants::T_INTEGER);
        }

        if ($access_refused !== null) {
            $wheres[] = "blocked=" . $this->ilias_database->quote($access_refused, ilDBConstants::T_INTEGER);
        }

        if ($tutorial_support !== null) {
            $wheres[] = "contact=" . $this->ilias_database->quote($tutorial_support, ilDBConstants::T_INTEGER);
        }

        if ($notification !== null) {
            $wheres[] = "notification=" . $this->ilias_database->quote($notification, ilDBConstants::T_INTEGER);
        }

        return "SELECT obj_members.*,object_data.obj_id,object_data.import_id,object_reference.ref_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id,status
FROM obj_members
INNER JOIN object_data ON obj_members.obj_id=object_data.obj_id
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN object_data AS object_data_user ON obj_members.usr_id=object_data_user.obj_id
LEFT JOIN ut_lp_marks ON ut_lp_marks.obj_id=object_data.obj_id AND ut_lp_marks.usr_id=object_data_user.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.obj_id ASC,object_data_user.obj_id ASC,object_reference.ref_id ASC";
    }


    private function mapCourseMemberDiff(CourseMemberDiffDto $diff, int $user_id, ilObjCourse $ilias_course) : void
    {
        $roles = [
            InternalCourseMemberType::ADMINISTRATOR->value => $diff->administrator_role !== null ? $diff->administrator_role : $ilias_course->getMembersObject()->isAdmin($user_id),
            InternalCourseMemberType::TUTOR->value         => $diff->tutor_role !== null ? $diff->tutor_role : $ilias_course->getMembersObject()->isTutor($user_id),
            InternalCourseMemberType::MEMBER->value        => $diff->member_role !== null ? $diff->member_role : $ilias_course->getMembersObject()->isMember($user_id)
        ];
        if (empty($roles = array_filter($roles))) {
            throw new LogicException("Course member must have at least one role");
        }
        if (!$ilias_course->getMembersObject()->isAssigned($user_id)) {
            $ilias_course->getMembersObject()->add($user_id, array_key_first($roles));
            $ilias_course->checkLPStatusSync($user_id);
        }
        $ilias_course->getMembersObject()->updateRoleAssignments($user_id, array_map([
            $ilias_course->getMembersObject(),
            "getAutoGeneratedRoleId"
        ], array_keys($roles)));

        if ($diff->learning_progress !== null) {
            ilLPStatus::writeStatus($ilias_course->getId(), $user_id, ObjectLearningProgressMapping::mapExternalToInternal($diff->learning_progress)->value);
        }

        if ($diff->passed !== null) {
            $ilias_course->getMembersObject()->updatePassed($user_id, $diff->passed);
            //(new ilObjectGUIFactory())->getInstanceByRefId($ilias_course->getRefId())->updateLPFromStatus($user_id, $diff->passed);
        }

        if ($roles[InternalCourseMemberType::ADMINISTRATOR->value] || $roles[InternalCourseMemberType::TUTOR->value]) {
            $ilias_course->getMembersObject()->updateBlocked($user_id, false);

            $ilias_course->getMembersObject()->updateContact($user_id, $diff->tutorial_support !== null ? $diff->tutorial_support : $ilias_course->getMembersObject()->isContact($user_id));

            $ilias_course->getMembersObject()
                ->updateNotification($user_id, $diff->notification !== null ? $diff->notification : $ilias_course->getMembersObject()->isNotificationEnabled($user_id));
        } else {
            $ilias_course->getMembersObject()->updateBlocked($user_id, $diff->access_refused !== null ? $diff->access_refused : $ilias_course->getMembersObject()->isBlocked($user_id));

            $ilias_course->getMembersObject()->updateContact($user_id, false);

            $ilias_course->getMembersObject()->updateNotification($user_id, false);
        }
    }


    private function mapCourseMemberDto(array $course_member) : CourseMemberDto
    {
        return CourseMemberDto::new(
            $course_member["obj_id"] ?: null,
            $course_member["import_id"] ?: null,
            $course_member["ref_id"] ?: null,
            $course_member["usr_id"] ?: null,
            $course_member["user_import_id"] ?: null,
            $course_member["member"] ?? false,
            $course_member["tutor"] ?? false,
            $course_member["admin"] ?? false,
            ($learning_progress = $course_member["status"] ?: null) !== null ? ObjectLearningProgressMapping::mapInternalToExternal(InternalObjectLearningProgress::from($learning_progress))
                : ObjectLearningProgress::NOT_ATTEMPTED,
            $course_member["passed"] ?? false,
            $course_member["blocked"] ?? false,
            $course_member["contact"] ?? false,
            $course_member["notification"] ?? false
        );
    }
}
