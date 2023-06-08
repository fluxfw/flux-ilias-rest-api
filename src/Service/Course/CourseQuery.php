<?php

namespace FluxIliasRestApi\Service\Course;

use FluxIliasRestApi\Adapter\Course\CourseDiffDto;
use FluxIliasRestApi\Adapter\Course\CourseDto;
use FluxIliasRestApi\Adapter\Course\CourseMailToMembersType;
use FluxIliasRestApi\Service\Object\CustomInternalObjectType;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use ilDate;
use ilDateTime;
use ilDBConstants;
use ilObjCourse;
use ilObjectServiceSettingsGUI;
use LogicException;

trait CourseQuery
{

    private function getCourseContainerSettingQuery(array $ids) : string
    {
        return "SELECT id,keyword,value
FROM container_settings
WHERE " . $this->ilias_database->in("id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL";
    }


    private function getCourseQuery(?int $id = null, ?string $import_id = null, ?int $ref_id = null, ?bool $in_trash = null) : string
    {
        $wheres = [
            "object_data.type=" . $this->ilias_database->quote(DefaultInternalObjectType::CRS->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "object_data.obj_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "object_data.import_id=" . $this->ilias_database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($ref_id !== null) {
            $wheres[] = "object_reference.ref_id=" . $this->ilias_database->quote($ref_id, ilDBConstants::T_INTEGER);
        }

        if ($in_trash !== null) {
            $wheres[] = "object_reference.deleted IS" . ($in_trash ? " NOT" : "") . " NULL";
        }

        return "SELECT object_data.*,object_reference.ref_id,object_reference.deleted,crs_settings.*,crs_items.timing_start,crs_items.timing_end,crs_items.visible AS timing_visible,didactic_tpl_objs.tpl_id,object_data_parent.obj_id AS parent_obj_id,object_reference_parent.ref_id AS parent_ref_id,object_data_parent.import_id AS parent_import_id
FROM object_data
LEFT JOIN object_reference ON object_data.obj_id=object_reference.obj_id
LEFT JOIN crs_settings ON object_data.obj_id=crs_settings.obj_id
LEFT JOIN crs_items ON object_reference.ref_id=crs_items.obj_id
LEFT JOIN didactic_tpl_objs ON object_data.obj_id=didactic_tpl_objs.obj_id
LEFT JOIN tree ON object_reference.ref_id=tree.child
LEFT JOIN object_reference AS object_reference_parent ON tree.parent=object_reference_parent.ref_id
LEFT JOIN object_data AS object_data_parent ON object_reference_parent.obj_id=object_data_parent.obj_id
WHERE " . implode(" AND ", $wheres) . "
GROUP BY object_data.obj_id
ORDER BY object_data.title ASC,object_data.create_date ASC,object_reference.ref_id ASC";
    }


    private function getIliasCourse(int $id, ?int $ref_id = null) : ?ilObjCourse
    {
        if ($ref_id !== null) {
            return new ilObjCourse($ref_id, true);
        } else {
            return new ilObjCourse($id, false);
        }
    }


    private function mapCourseDiff(CourseDiffDto $diff, ilObjCourse $ilias_course) : void
    {
        if ($diff->import_id !== null) {
            $ilias_course->setImportId($diff->import_id);
        }

        if ($diff->title !== null) {
            $ilias_course->setTitle($diff->title);
        }

        if ($diff->description !== null) {
            $ilias_course->setDescription($diff->description);
        }

        if ($diff->period_start !== null || $diff->period_end !== null) {
            $period_date_class = ($diff->period_time_indication ?? $ilias_course->getCourseStartTimeIndication()) ? ilDateTime::class : ilDate::class;

            $ilias_course->setCoursePeriod(
                $diff->period_start !== null ? new $period_date_class($diff->period_start, IL_CAL_UNIX) : $ilias_course->getCourseStart(),
                $diff->period_end !== null ? new $period_date_class($diff->period_end, IL_CAL_UNIX) : $ilias_course->getCourseEnd()
            );
        }

        if ($diff->period_unset !== null) {
            if ($diff->period_start !== null || $diff->period_end !== null) {
                throw new LogicException("Can't both set and unset period date");
            }

            if ($diff->period_unset) {
                $ilias_course->setCoursePeriod(null, null);
            }
        }

        if ($diff->online !== null) {
            $ilias_course->setOfflineStatus(!$diff->online);
        }

        if ($diff->availability_start !== null) {
            $ilias_course->setActivationStart($diff->availability_start);
        }

        if ($diff->availability_end !== null) {
            $ilias_course->setActivationEnd($diff->availability_end);
        }

        if ($diff->availability_always_visible !== null) {
            $ilias_course->setActivationVisibility($diff->availability_always_visible);
        }

        if ($diff->calendar !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CALENDAR_ACTIVATION, $diff->calendar);
        }

        if ($diff->calendar_block !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CALENDAR_VISIBILITY, $diff->calendar_block);
        }

        if ($diff->news !== null) {
            $ilias_course->setUseNews($diff->news);
        }

        if ($diff->news_block !== null) {
            $ilias_course->setNewsBlockActivated($diff->news_block);
        }

        if ($diff->manage_custom_metadata !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::CUSTOM_METADATA, $diff->manage_custom_metadata);
        }

        if ($diff->tag_cloud !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::TAG_CLOUD, $diff->tag_cloud);
        }

        if ($diff->default_object_rating !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::AUTO_RATING_NEW_OBJECTS, $diff->default_object_rating);
        }

        if ($diff->badges !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::BADGES, $diff->badges);
        }

        if ($diff->resources !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::BOOKING, $diff->resources);
        }

        if ($diff->mail_subject_prefix !== null) {
            $ilias_course::_writeContainerSetting($ilias_course->getId(), ilObjectServiceSettingsGUI::EXTERNAL_MAIL_PREFIX, $diff->mail_subject_prefix);
        }

        if ($diff->show_members !== null) {
            $ilias_course->setShowMembers($diff->show_members);
        }

        if ($diff->show_members_participants_list !== null) {
            $ilias_course->setShowMembersExport($diff->show_members_participants_list);
        }

        if ($diff->mail_to_members_type !== null) {
            $ilias_course->setMailToMembersType(CourseMailToMembersTypeMapping::mapExternalToInternal($diff->mail_to_members_type)->value);
        }

        if ($diff->send_welcome_email !== null) {
            $ilias_course->setAutoNotification($diff->send_welcome_email);
        }

        if ($diff->add_to_favourites !== null) {
            $ilias_course->setAboStatus($diff->add_to_favourites);
        }

        if ($diff->important_information !== null) {
            $ilias_course->setImportantInformation($diff->important_information);
        }

        if ($diff->syllabus !== null) {
            $ilias_course->setSyllabus($diff->syllabus);
        }

        if ($diff->target_group !== null) {
            $ilias_course->setTargetGroup($diff->target_group);
        }

        if ($diff->contact_name !== null) {
            $ilias_course->setContactName($diff->contact_name);
        }

        if ($diff->contact_responsibility !== null) {
            $ilias_course->setContactResponsibility($diff->contact_responsibility);
        }

        if ($diff->contact_phone !== null) {
            $ilias_course->setContactPhone($diff->contact_phone);
        }

        if ($diff->contact_email !== null) {
            $ilias_course->setContactEmail($diff->contact_email);
        }

        if ($diff->contact_consultation !== null) {
            $ilias_course->setContactConsultation($diff->contact_consultation);
        }

        if ($diff->didactic_template_id !== null) {
            $ilias_course->applyDidacticTemplate($diff->didactic_template_id);
        }

        if ($diff->custom_metadata !== null) {
            $this->updateCustomMetadata(
                $ilias_course->getId(),
                $diff->custom_metadata
            );
        }
    }


    private function mapCourseDto(array $course, ?array $container_settings = null, bool $custom_metadata = false) : CourseDto
    {
        $getCourseContainerSetting = fn(string $field, mixed $null_default_value = null) : mixed => $container_settings !== null ? current(array_map(fn(array $container_setting
        ) : mixed => $container_setting["value"] ?? $null_default_value,
            array_filter($container_settings, fn(array $container_setting) : bool => $container_setting["id"] === $course["obj_id"] && $container_setting["keyword"] === $field))) : null;

        $type = ($type = $course["type"] ?: null) !== null ? CustomInternalObjectType::factory(
            $type
        ) : null;

        return CourseDto::new(
            $course["obj_id"] ?: null,
            $course["import_id"] ?: null,
            $course["ref_id"] ?: null,
            $this->convertDateTimeStringToTimestamp(
                $course["create_date"] ?? null
            ),
            $this->convertDateTimeStringToTimestamp(
                $course["last_update"] ?? null
            ),
            $course["parent_obj_id"] ?: null,
            $course["parent_import_id"] ?: null,
            $course["parent_ref_id"] ?: null,
            $this->getObjectUrl(
                $course["ref_id"] ?: null,
                $type
            ),
            $this->getObjectIconUrl(
                $course["obj_id"] ?: null,
                $type
            ),
            $course["title"] ?? "",
            $course["description"] ?? "",
            $this->convertDateTimeStringToTimestamp(
                $course["period_start"] ?? null
            ),
            $this->convertDateTimeStringToTimestamp(
                $course["period_end"] ?? null
            ),
            $course["period_time_indication"] ?? false,
            !($course["offline"] ?? null),
            $course["timing_start"] ?: null,
            $course["timing_end"] ?: null,
            $course["timing_visible"] ?? false,
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::CALENDAR_ACTIVATION,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::CALENDAR_VISIBILITY,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::USE_NEWS,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::NEWS_VISIBILITY,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::CUSTOM_METADATA,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::TAG_CLOUD,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::AUTO_RATING_NEW_OBJECTS,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::BADGES,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::BOOKING,
                false
            ),
            $getCourseContainerSetting(
                ilObjectServiceSettingsGUI::EXTERNAL_MAIL_PREFIX,
                ""
            ),
            $course["show_members"] ?? false,
            $course["show_members_export"] ?? false,
            ($mail_to_members_type = $course["mail_members_type"] ?: null) !== null
                ? CourseMailToMembersTypeMapping::mapInternalToExternal(InternalCourseMailToMembersType::from($mail_to_members_type)) : CourseMailToMembersType::ALL,
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
            $course["tpl_id"] ?: null,
            ($course["deleted"] ?? null) !== null,
            $custom_metadata ? $this->getCustomMetadata(
                $course["obj_id"] ?: null
            ) : null
        );
    }


    private function newIliasCourse() : ilObjCourse
    {
        return new ilObjCourse();
    }
}
