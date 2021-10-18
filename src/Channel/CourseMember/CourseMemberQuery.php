<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\CourseMember;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\CourseMember\CourseMemberDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use Fluxlabs\FluxIliasRestApi\Channel\ObjectLearningProgress\ObjectLearningProgressMapping;
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
        ?string $learning_progress = null,
        ?bool $passed = null,
        ?bool $access_refused = null,
        ?bool $tutorial_support = null,
        ?bool $notification = null
    ) : string {
        $wheres = [
            "object_data.type=" . $this->database->quote(InternalObjectType::CRS, ilDBConstants::T_TEXT),
            "object_data_user.type=" . $this->database->quote(InternalObjectType::USR, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($course_id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($course_id, ilDBConstants::T_INTEGER);
        }

        if ($course_import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($course_import_id, ilDBConstants::T_TEXT);
        }

        if ($course_ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($course_ref_id, ilDBConstants::T_INTEGER);
        }

        if ($user_id !== null) {
            $wheres[] = "object_data_user.obj_id=" . $this->database->quote($user_id, ilDBConstants::T_INTEGER);
        }

        if ($user_import_id !== null) {
            $wheres[] = "object_data_user.import_id=" . $this->database->quote($user_import_id, ilDBConstants::T_TEXT);
        }

        if ($member_role !== null) {
            $wheres[] = "member=" . $this->database->quote($member_role, ilDBConstants::T_INTEGER);
        }

        if ($tutor_role !== null) {
            $wheres[] = "tutor=" . $this->database->quote($tutor_role, ilDBConstants::T_INTEGER);
        }

        if ($administrator_role !== null) {
            $wheres[] = "admin=" . $this->database->quote($administrator_role, ilDBConstants::T_INTEGER);
        }

        if ($learning_progress !== null) {
            $wheres[] = "status=" . $this->database->quote(ObjectLearningProgressMapping::mapExternalToInternal(
                    $learning_progress
                ), ilDBConstants::T_INTEGER);
        }

        if ($passed !== null) {
            $wheres[] = "passed=" . $this->database->quote($passed, ilDBConstants::T_INTEGER);
        }

        if ($access_refused !== null) {
            $wheres[] = "blocked=" . $this->database->quote($access_refused, ilDBConstants::T_INTEGER);
        }

        if ($tutorial_support !== null) {
            $wheres[] = "contact=" . $this->database->quote($tutorial_support, ilDBConstants::T_INTEGER);
        }

        if ($notification !== null) {
            $wheres[] = "notification=" . $this->database->quote($notification, ilDBConstants::T_INTEGER);
        }

        return "SELECT obj_members.*,object_data.obj_id,object_data.import_id,object_reference.ref_id,object_data_user.obj_id AS usr_id,object_data_user.import_id AS user_import_id,status
FROM obj_members
INNER JOIN object_data ON obj_members.obj_id=object_data.obj_id
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN object_data AS object_data_user ON obj_members.usr_id=object_data_user.obj_id
LEFT JOIN ut_lp_marks ON ut_lp_marks.obj_id=object_data.obj_id AND ut_lp_marks.usr_id=object_data_user.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.obj_id ASC,object_data_user.obj_id ASC";
    }


    private function mapCourseMemberDiff(CourseMemberDiffDto $diff, int $user_id, ilObjCourse $ilias_course) : void
    {
        $roles = [
            InternalCourseMemberType::ADMINISTRATOR => $diff->isAdministratorRole() !== null ? $diff->isAdministratorRole() : $ilias_course->getMembersObject()->isAdmin($user_id),
            InternalCourseMemberType::TUTOR         => $diff->isTutorRole() !== null ? $diff->isTutorRole() : $ilias_course->getMembersObject()->isTutor($user_id),
            InternalCourseMemberType::MEMBER        => $diff->isMemberRole() !== null ? $diff->isMemberRole() : $ilias_course->getMembersObject()->isMember($user_id)
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

        if ($diff->getLearningProgress() !== null) {
            ilLPStatus::writeStatus($ilias_course->getId(), $user_id, ObjectLearningProgressMapping::mapExternalToInternal(
                $diff->getLearningProgress()
            ));
        }

        if ($diff->isPassed() !== null) {
            $ilias_course->getMembersObject()->updatePassed($user_id, $diff->isPassed());
            //(new ilObjectGUIFactory())->getInstanceByRefId($ilias_course->getRefId())->updateLPFromStatus($user_id, $diff->isPassed());
        }

        if ($roles[InternalCourseMemberType::ADMINISTRATOR] || $roles[InternalCourseMemberType::TUTOR]) {
            $ilias_course->getMembersObject()->updateBlocked($user_id, false);

            $ilias_course->getMembersObject()->updateContact($user_id, $diff->isTutorialSupport() !== null ? $diff->isTutorialSupport() : $ilias_course->getMembersObject()->isContact($user_id));

            $ilias_course->getMembersObject()
                ->updateNotification($user_id, $diff->isNotification() !== null ? $diff->isNotification() : $ilias_course->getMembersObject()->isNotificationEnabled($user_id));
        } else {
            $ilias_course->getMembersObject()->updateBlocked($user_id, $diff->isAccessRefused() !== null ? $diff->isAccessRefused() : $ilias_course->getMembersObject()->isBlocked($user_id));

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
            ObjectLearningProgressMapping::mapInternalToExternal(
                $course_member["status"] ?? null
            ),
            $course_member["passed"] ?? false,
            $course_member["blocked"] ?? false,
            $course_member["contact"] ?? false,
            $course_member["notification"] ?? false
        );
    }
}
