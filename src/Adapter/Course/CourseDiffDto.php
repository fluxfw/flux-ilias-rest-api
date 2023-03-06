<?php

namespace FluxIliasRestApi\Adapter\Course;

use FluxIliasRestApi\Adapter\CustomMetadata\CustomMetadataDto;

class CourseDiffDto
{

    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?int $period_start,
        public readonly ?int $period_end,
        public readonly ?bool $period_unset,
        public readonly ?bool $period_time_indication,
        public readonly ?bool $online,
        public readonly ?int $availability_start,
        public readonly ?int $availability_end,
        public readonly ?bool $availability_always_visible,
        public readonly ?bool $calendar,
        public readonly ?bool $calendar_block,
        public readonly ?bool $news,
        public readonly ?bool $news_block,
        public readonly ?bool $manage_custom_metadata,
        public readonly ?bool $tag_cloud,
        public readonly ?bool $default_object_rating,
        public readonly ?bool $badges,
        public readonly ?bool $resources,
        public readonly ?string $mail_subject_prefix,
        public readonly ?bool $show_members,
        public readonly ?bool $show_members_participants_list,
        public readonly ?CourseMailToMembersType $mail_to_members_type,
        public readonly ?bool $send_welcome_email,
        public readonly ?bool $add_to_favourites,
        public readonly ?string $important_information,
        public readonly ?string $syllabus,
        public readonly ?string $target_group,
        public readonly ?string $contact_name,
        public readonly ?string $contact_responsibility,
        public readonly ?string $contact_phone,
        public readonly ?string $contact_email,
        public readonly ?string $contact_consultation,
        public readonly ?int $didactic_template_id,
        public readonly ?array $custom_metadata
    ) {

    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $period_start = null,
        ?int $period_end = null,
        ?bool $period_unset = null,
        ?bool $period_time_indication = null,
        ?bool $online = null,
        ?int $availability_start = null,
        ?int $availability_end = null,
        ?bool $availability_always_visible = null,
        ?bool $calendar = null,
        ?bool $calendar_block = null,
        ?bool $news = null,
        ?bool $news_block = null,
        ?bool $manage_custom_metadata = null,
        ?bool $tag_cloud = null,
        ?bool $default_object_rating = null,
        ?bool $badges = null,
        ?bool $resources = null,
        ?string $mail_subject_prefix = null,
        ?bool $show_members = null,
        ?bool $show_members_participants_list = null,
        ?CourseMailToMembersType $mail_to_members_type = null,
        ?bool $send_welcome_email = null,
        ?bool $add_to_favourites = null,
        ?string $important_information = null,
        ?string $syllabus = null,
        ?string $target_group = null,
        ?string $contact_name = null,
        ?string $contact_responsibility = null,
        ?string $contact_phone = null,
        ?string $contact_email = null,
        ?string $contact_consultation = null,
        ?int $didactic_template_id = null,
        ?array $custom_metadata = null
    ) : static {
        return new static(
            $import_id,
            $title,
            $description,
            $period_start,
            $period_end,
            $period_unset,
            $period_time_indication,
            $online,
            $availability_start,
            $availability_end,
            $availability_always_visible,
            $calendar,
            $calendar_block,
            $news,
            $news_block,
            $manage_custom_metadata,
            $tag_cloud,
            $default_object_rating,
            $badges,
            $resources,
            $mail_subject_prefix,
            $show_members,
            $show_members_participants_list,
            $mail_to_members_type,
            $send_welcome_email,
            $add_to_favourites,
            $important_information,
            $syllabus,
            $target_group,
            $contact_name,
            $contact_responsibility,
            $contact_phone,
            $contact_email,
            $contact_consultation,
            $didactic_template_id,
            $custom_metadata
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->title ?? null,
            $diff->description ?? null,
            $diff->period_start ?? null,
            $diff->period_end ?? null,
            $diff->period_unset ?? null,
            $diff->period_time_indication ?? null,
            $diff->online ?? null,
            $diff->availability_start ?? null,
            $diff->availability_end ?? null,
            $diff->availability_always_visible ?? null,
            $diff->calendar ?? null,
            $diff->calendar_block ?? null,
            $diff->news ?? null,
            $diff->news_block ?? null,
            $diff->manage_custom_metadata ?? null,
            $diff->tag_cloud ?? null,
            $diff->default_object_rating ?? null,
            $diff->badges ?? null,
            $diff->resources ?? null,
            $diff->mail_subject_prefix ?? null,
            $diff->show_members ?? null,
            $diff->show_members_participants_list ?? null,
            ($mail_to_members_type = $diff->mail_to_members_type ?? null) !== null ? CourseMailToMembersType::from($mail_to_members_type) : null,
            $diff->send_welcome_email ?? null,
            $diff->add_to_favourites ?? null,
            $diff->important_information ?? null,
            $diff->syllabus ?? null,
            $diff->target_group ?? null,
            $diff->contact_name ?? null,
            $diff->contact_responsibility ?? null,
            $diff->contact_phone ?? null,
            $diff->contact_email ?? null,
            $diff->contact_consultation ?? null,
            $diff->didactic_template_id ?? null,
            ($custom_metadata = $diff->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromObject"], $custom_metadata) : null
        );
    }
}
