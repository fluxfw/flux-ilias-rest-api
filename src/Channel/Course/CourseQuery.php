<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Course;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\Course\CourseDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDate;
use ilDateTime;
use ilDBConstants;
use ilObjCourse;
use ilObjectServiceSettingsGUI;
use LogicException;

trait CourseQuery
{

    private function getContainerSettingQuery(array $ids) : string
    {
        return "SELECT id,keyword,value
FROM container_settings
WHERE " . $this->database->in("id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL";
    }


    private function getCourseQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->database->quote(InternalObjectType::CRS, ilDBConstants::T_TEXT),
            "object_reference.deleted IS NULL"
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        return "SELECT object_data.*,object_reference.ref_id,crs_settings.*,crs_items.timing_start,crs_items.timing_end,crs_items.visible AS timing_visible,didactic_tpl_objs.tpl_id,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
INNER JOIN crs_settings ON object_data.obj_id=crs_settings.obj_id
LEFT JOIN crs_items ON object_reference.ref_id=crs_items.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
INNER JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY object_data.title ASC,object_data.create_date ASC";
    }


    private function getIliasCourse(int $ref_id) : ?ilObjCourse
    {
        return new ilObjCourse($ref_id);
    }


    private function mapCourseDiff(CourseDiffDto $diff, ilObjCourse $ilias_course) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_course->setImportId($diff->getImportId());
        }

        if ($diff->getTitle() !== null) {
            $ilias_course->setTitle($diff->getTitle());
        }

        if ($diff->getDescription() !== null) {
            $ilias_course->setDescription($diff->getDescription());
        }

        if ($diff->getPeriodStart() !== null || $diff->getPeriodEnd() !== null) {
            $period_date_class = ($diff->isPeriodTimeIndication() ?? $ilias_course->getCourseStartTimeIndication()) ? ilDateTime::class : ilDate::class;

            $ilias_course->setCoursePeriod(
                $diff->getPeriodStart() !== null ? new $period_date_class($diff->getPeriodStart(), IL_CAL_UNIX) : $ilias_course->getCourseStart(),
                $diff->getPeriodEnd() !== null ? new $period_date_class($diff->getPeriodEnd(), IL_CAL_UNIX) : $ilias_course->getCourseEnd()
            );
        }

        if ($diff->isPeriodUnset() !== null) {
            if ($diff->getPeriodStart() !== null || $diff->getPeriodEnd() !== null) {
                throw new LogicException("Can't both set and unset period date");
            }

            if ($diff->isPeriodUnset()) {
                $ilias_course->setCoursePeriod(null, null);
            }
        }

        if ($diff->isOnline() !== null) {
            $ilias_course->setOfflineStatus(!$diff->isOnline());
        }

        if ($diff->getAvailabilityStart() !== null) {
            $ilias_course->setActivationStart(!$diff->getAvailabilityStart());
        }

        if ($diff->getAvailabilityEnd() !== null) {
            $ilias_course->setActivationEnd(!$diff->getAvailabilityEnd());
        }

        if ($diff->isAvailabilityAlwaysVisible() !== null) {
            $ilias_course->setActivationVisibility(!$diff->isAvailabilityAlwaysVisible());
        }

        if ($diff->isCalendar() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CALENDAR_ACTIVATION, $diff->isCalendar());
        }

        if ($diff->isCalendarBlock() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CALENDAR_VISIBILITY, $diff->isCalendarBlock());
        }

        if ($diff->isNews() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::USE_NEWS, $diff->isNews());
        }

        if ($diff->isCustomMetadata() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CUSTOM_METADATA, $diff->isCustomMetadata());
        }

        if ($diff->isTagCloud() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::TAG_CLOUD, $diff->isTagCloud());
        }

        if ($diff->isDefaultObjectRating() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::AUTO_RATING_NEW_OBJECTS, $diff->isDefaultObjectRating());
        }

        if ($diff->isBadges() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::BADGES, $diff->isBadges());
        }

        if ($diff->isResources() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::BOOKING, $diff->isResources());
        }

        if ($diff->getMailSubjectPrefix() !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::EXTERNAL_MAIL_PREFIX, $diff->getMailSubjectPrefix());
        }

        if ($diff->isShowMembers() !== null) {
            $ilias_course->setShowMembers(!$diff->isShowMembers());
        }

        if ($diff->isShowMembersParticipantsList() !== null) {
            $ilias_course->setShowMembersExport(!$diff->isShowMembersParticipantsList());
        }

        if ($diff->getMailToMembersType() !== null) {
            $ilias_course->setMailToMembersType(MailToMembersTypeMapping::mapExternalToInternal(
                $diff->getMailToMembersType()
            ));
        }

        if ($diff->isSendWelcomeEmail() !== null) {
            $ilias_course->setAutoNotification(!$diff->isSendWelcomeEmail());
        }

        if ($diff->isAddToFavourites() !== null) {
            $ilias_course->setAboStatus(!$diff->isAddToFavourites());
        }

        if ($diff->getImportantInformation() !== null) {
            $ilias_course->setImportantInformation(!$diff->getImportantInformation());
        }

        if ($diff->getSyllabus() !== null) {
            $ilias_course->setSyllabus(!$diff->getSyllabus());
        }

        if ($diff->getTargetGroup() !== null) {
            $ilias_course->setTargetGroup(!$diff->getTargetGroup());
        }

        if ($diff->getContactName() !== null) {
            $ilias_course->setContactName(!$diff->getContactName());
        }

        if ($diff->getContactResponsibility() !== null) {
            $ilias_course->setContactResponsibility(!$diff->getContactResponsibility());
        }

        if ($diff->getContactPhone() !== null) {
            $ilias_course->setContactPhone(!$diff->getContactPhone());
        }

        if ($diff->getContactEmail() !== null) {
            $ilias_course->setContactEmail(!$diff->getContactEmail());
        }

        if ($diff->getContactConsultation() !== null) {
            $ilias_course->setContactConsultation(!$diff->getContactConsultation());
        }

        if ($diff->getDidacticTemplateId() !== null) {
            $ilias_course->applyDidacticTemplate(!$diff->getDidacticTemplateId());
        }
    }


    private function mapCourseDto(array $course, ?array $container_settings = null) : CourseDto
    {
        $getContainerSetting = fn(string $field, /*mixed*/ $null_default_value = null)/* : mixed*/ => $container_settings !== null ? current(array_map(fn(array $container_setting
        )/* : mixed*/ => $container_setting["value"] ?? $null_default_value,
            array_filter($container_settings, fn(array $container_setting) : bool => $container_setting["id"] === $course["obj_id"] && $container_setting["keyword"] === $field))) : null;

        return CourseDto::new(
            $course["obj_id"] ?: null,
            $course["import_id"] ?: null,
            $course["ref_id"] ?: null,
            strtotime($course["create_date"] ?? null) ?: null,
            strtotime($course["last_update"] ?? null) ?: null,
            $course["parent_obj_id"] ?: null,
            $course["parent_import_id"] ?: null,
            $course["parent_ref_id"] ?: null,
            $course["title"] ?? "",
            $course["description"] ?? "",
            strtotime($course["period_start"]) ?: null,
            strtotime($course["period_end"]) ?: null,
            $course["period_time_indication"] ?? false,
            !($course["offline"] ?? null),
            $course["timing_start"] ?: null,
            $course["timing_end"] ?: null,
            $course["timing_visible"] ?? false,
            $getContainerSetting(
                ilObjectServiceSettingsGUI::CALENDAR_ACTIVATION,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::CALENDAR_VISIBILITY,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::USE_NEWS,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::CUSTOM_METADATA,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::TAG_CLOUD,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::AUTO_RATING_NEW_OBJECTS,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::BADGES,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::BOOKING,
                false
            ),
            $getContainerSetting(
                ilObjectServiceSettingsGUI::EXTERNAL_MAIL_PREFIX,
                ""
            ),
            $course["show_members"] ?? false,
            $course["show_members_export"] ?? false,
            MailToMembersTypeMapping::mapInternalToExternal(
                $course["mail_members_type"] ?? null
            ),
            $course["auto_notification"] ?? false,
            $course["abo"] ?? false,
            $course["important"] ?? "",
            $course["syllabus"] ?? "",
            $course["target_group"] ?? "",
            $course["contact_name"] ?? "",
            $course["contact_responsibility"] ?? "",
            $course["contact_phone"] ?? "",
            $course["contact_email"] ?? "",
            $course["contact_consultation"] ?? "",
            $course["tpl_id"] ?: null
        );
    }


    private function newIliasCourse() : ilObjCourse
    {
        return new ilObjCourse();
    }
}
