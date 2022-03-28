<?php

namespace FluxIliasRestApi\Adapter\Course;

class CourseDiffDto
{

    private ?bool $add_to_favourites;
    private ?bool $availability_always_visible;
    private ?int $availability_end;
    private ?int $availability_start;
    private ?bool $badges;
    private ?bool $calendar;
    private ?bool $calendar_block;
    private ?string $contact_consultation;
    private ?string $contact_email;
    private ?string $contact_name;
    private ?string $contact_phone;
    private ?string $contact_responsibility;
    private ?bool $custom_metadata;
    private ?bool $default_object_rating;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $import_id;
    private ?string $important_information;
    private ?string $mail_subject_prefix;
    private ?LegacyCourseMailToMembersType $mail_to_members_type;
    private ?bool $news;
    private ?bool $online;
    private ?int $period_end;
    private ?int $period_start;
    private ?bool $period_time_indication;
    private ?bool $period_unset;
    private ?bool $resources;
    private ?bool $send_welcome_email;
    private ?bool $show_members;
    private ?bool $show_members_participants_list;
    private ?string $syllabus;
    private ?bool $tag_cloud;
    private ?string $target_group;
    private ?string $title;


    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $period_start,
        /*public readonly*/ ?int $period_end,
        /*public readonly*/ ?bool $period_unset,
        /*public readonly*/ ?bool $period_time_indication,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?int $availability_start,
        /*public readonly*/ ?int $availability_end,
        /*public readonly*/ ?bool $availability_always_visible,
        /*public readonly*/ ?bool $calendar,
        /*public readonly*/ ?bool $calendar_block,
        /*public readonly*/ ?bool $news,
        /*public readonly*/ ?bool $custom_metadata,
        /*public readonly*/ ?bool $tag_cloud,
        /*public readonly*/ ?bool $default_object_rating,
        /*public readonly*/ ?bool $badges,
        /*public readonly*/ ?bool $resources,
        /*public readonly*/ ?string $mail_subject_prefix,
        /*public readonly*/ ?bool $show_members,
        /*public readonly*/ ?bool $show_members_participants_list,
        /*public readonly*/ ?LegacyCourseMailToMembersType $mail_to_members_type,
        /*public readonly*/ ?bool $send_welcome_email,
        /*public readonly*/ ?bool $add_to_favourites,
        /*public readonly*/ ?string $important_information,
        /*public readonly*/ ?string $syllabus,
        /*public readonly*/ ?string $target_group,
        /*public readonly*/ ?string $contact_name,
        /*public readonly*/ ?string $contact_responsibility,
        /*public readonly*/ ?string $contact_phone,
        /*public readonly*/ ?string $contact_email,
        /*public readonly*/ ?string $contact_consultation,
        /*public readonly*/ ?int $didactic_template_id
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
        $this->period_start = $period_start;
        $this->period_end = $period_end;
        $this->period_unset = $period_unset;
        $this->period_time_indication = $period_time_indication;
        $this->online = $online;
        $this->availability_start = $availability_start;
        $this->availability_end = $availability_end;
        $this->availability_always_visible = $availability_always_visible;
        $this->calendar = $calendar;
        $this->calendar_block = $calendar_block;
        $this->news = $news;
        $this->custom_metadata = $custom_metadata;
        $this->tag_cloud = $tag_cloud;
        $this->default_object_rating = $default_object_rating;
        $this->badges = $badges;
        $this->resources = $resources;
        $this->mail_subject_prefix = $mail_subject_prefix;
        $this->show_members = $show_members;
        $this->show_members_participants_list = $show_members_participants_list;
        $this->mail_to_members_type = $mail_to_members_type;
        $this->send_welcome_email = $send_welcome_email;
        $this->add_to_favourites = $add_to_favourites;
        $this->important_information = $important_information;
        $this->syllabus = $syllabus;
        $this->target_group = $target_group;
        $this->contact_name = $contact_name;
        $this->contact_responsibility = $contact_responsibility;
        $this->contact_phone = $contact_phone;
        $this->contact_email = $contact_email;
        $this->contact_consultation = $contact_consultation;
        $this->didactic_template_id = $didactic_template_id;
    }


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
        ?bool $custom_metadata = null,
        ?bool $tag_cloud = null,
        ?bool $default_object_rating = null,
        ?bool $badges = null,
        ?bool $resources = null,
        ?string $mail_subject_prefix = null,
        ?bool $show_members = null,
        ?bool $show_members_participants_list = null,
        ?LegacyCourseMailToMembersType $mail_to_members_type = null,
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
        ?int $didactic_template_id = null
    ) : /*static*/ self
    {
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
            $custom_metadata,
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
            $didactic_template_id
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            $data->period_start ?? null,
            $data->period_end ?? null,
            $data->period_unset ?? null,
            $data->period_time_indication ?? null,
            $data->online ?? null,
            $data->availability_start ?? null,
            $data->availability_end ?? null,
            $data->availability_always_visible ?? null,
            $data->calendar ?? null,
            $data->calendar_block ?? null,
            $data->news ?? null,
            $data->custom_metadata ?? null,
            $data->tag_cloud ?? null,
            $data->default_object_rating ?? null,
            $data->badges ?? null,
            $data->resources ?? null,
            $data->mail_subject_prefix ?? null,
            $data->show_members ?? null,
            $data->show_members_participants_list ?? null,
            ($mail_to_members_type = $data->mail_to_members_type ?? null) !== null ? LegacyCourseMailToMembersType::from($mail_to_members_type) : null,
            $data->send_welcome_email ?? null,
            $data->add_to_favourites ?? null,
            $data->important_information ?? null,
            $data->syllabus ?? null,
            $data->target_group ?? null,
            $data->contact_name ?? null,
            $data->contact_responsibility ?? null,
            $data->contact_phone ?? null,
            $data->contact_email ?? null,
            $data->contact_consultation ?? null,
            $data->didactic_template_id ?? null
        );
    }


    public function getAvailabilityEnd() : ?int
    {
        return $this->availability_end;
    }


    public function getAvailabilityStart() : ?int
    {
        return $this->availability_start;
    }


    public function getContactConsultation() : ?string
    {
        return $this->contact_consultation;
    }


    public function getContactEmail() : ?string
    {
        return $this->contact_email;
    }


    public function getContactName() : ?string
    {
        return $this->contact_name;
    }


    public function getContactPhone() : ?string
    {
        return $this->contact_phone;
    }


    public function getContactResponsibility() : ?string
    {
        return $this->contact_responsibility;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getImportantInformation() : ?string
    {
        return $this->important_information;
    }


    public function getMailSubjectPrefix() : ?string
    {
        return $this->mail_subject_prefix;
    }


    public function getMailToMembersType() : ?LegacyCourseMailToMembersType
    {
        return $this->mail_to_members_type;
    }


    public function getPeriodEnd() : ?int
    {
        return $this->period_end;
    }


    public function getPeriodStart() : ?int
    {
        return $this->period_start;
    }


    public function getSyllabus() : ?string
    {
        return $this->syllabus;
    }


    public function getTargetGroup() : ?string
    {
        return $this->target_group;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function isAddToFavourites() : ?bool
    {
        return $this->add_to_favourites;
    }


    public function isAvailabilityAlwaysVisible() : ?bool
    {
        return $this->availability_always_visible;
    }


    public function isBadges() : ?bool
    {
        return $this->badges;
    }


    public function isCalendar() : ?bool
    {
        return $this->calendar;
    }


    public function isCalendarBlock() : ?bool
    {
        return $this->calendar_block;
    }


    public function isCustomMetadata() : ?bool
    {
        return $this->custom_metadata;
    }


    public function isDefaultObjectRating() : ?bool
    {
        return $this->default_object_rating;
    }


    public function isNews() : ?bool
    {
        return $this->news;
    }


    public function isOnline() : ?bool
    {
        return $this->online;
    }


    public function isPeriodTimeIndication() : ?bool
    {
        return $this->period_time_indication;
    }


    public function isPeriodUnset() : ?bool
    {
        return $this->period_unset;
    }


    public function isResources() : ?bool
    {
        return $this->resources;
    }


    public function isSendWelcomeEmail() : ?bool
    {
        return $this->send_welcome_email;
    }


    public function isShowMembers() : ?bool
    {
        return $this->show_members;
    }


    public function isShowMembersParticipantsList() : ?bool
    {
        return $this->show_members_participants_list;
    }


    public function isTagCloud() : ?bool
    {
        return $this->tag_cloud;
    }
}
