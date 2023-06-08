<?php

namespace FluxIliasRestApi\Adapter\Course;

use FluxIliasRestApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class CourseDto implements JsonSerializable
{

    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?int $ref_id,
        public readonly ?float $created,
        public readonly ?float $updated,
        public readonly ?int $parent_id,
        public readonly ?string $parent_import_id,
        public readonly ?int $parent_ref_id,
        public readonly ?string $url,
        public readonly ?string $icon_url,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?float $period_start,
        public readonly ?float $period_end,
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
        public readonly ?bool $in_trash,
        public readonly ?array $custom_metadata
    ) {

    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?float $created = null,
        ?float $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?float $period_start = null,
        ?float $period_end = null,
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
        ?bool $in_trash = null,
        ?array $custom_metadata = null
    ) : static {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $title,
            $description,
            $period_start,
            $period_end,
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
            $in_trash,
            $custom_metadata
        );
    }


    public static function newFromObject(
        object $course
    ) : static {
        return static::new(
            $course->id ?? null,
            $course->import_id ?? null,
            $course->ref_id ?? null,
            $course->created ?? null,
            $course->updated ?? null,
            $course->parent_id ?? null,
            $course->parent_import_id ?? null,
            $course->parent_ref_id ?? null,
            $course->url ?? null,
            $course->icon_url ?? null,
            $course->title ?? null,
            $course->description ?? null,
            $course->period_start ?? null,
            $course->period_end ?? null,
            $course->period_time_indication ?? null,
            $course->online ?? null,
            $course->availability_start ?? null,
            $course->availability_end ?? null,
            $course->availability_always_visible ?? null,
            $course->calendar ?? null,
            $course->calendar_block ?? null,
            $course->news ?? null,
            $course->news_block ?? null,
            $course->manage_custom_metadata ?? null,
            $course->tag_cloud ?? null,
            $course->default_object_rating ?? null,
            $course->badges ?? null,
            $course->resources ?? null,
            $course->mail_subject_prefix ?? null,
            $course->show_members ?? null,
            $course->show_members_participants_list ?? null,
            ($mail_to_members_type = $course->mail_to_members_type ?? null) !== null ? CourseMailToMembersType::from($mail_to_members_type) : null,
            $course->send_welcome_email ?? null,
            $course->add_to_favourites ?? null,
            $course->important_information ?? null,
            $course->syllabus ?? null,
            $course->target_group ?? null,
            $course->contact_name ?? null,
            $course->contact_responsibility ?? null,
            $course->contact_phone ?? null,
            $course->contact_email ?? null,
            $course->contact_consultation ?? null,
            $course->didactic_template_id ?? null,
            $course->in_trash ?? null,
            ($custom_metadata = $course->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromObject"], $custom_metadata) : null
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
