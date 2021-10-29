<?php

namespace FluxIliasRestApi\Adapter\Api\Course;

use JsonSerializable;

class CourseDto implements JsonSerializable
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
    private ?int $created;
    private ?bool $custom_metadata;
    private ?bool $default_object_rating;
    private ?string $description;
    private ?int $didactic_template_id;
    private ?string $icon_url;
    private ?int $id;
    private ?string $import_id;
    private ?string $important_information;
    private ?string $mail_subject_prefix;
    private ?string $mail_to_members_type;
    private ?bool $news;
    private ?bool $online;
    private ?int $parent_id;
    private ?string $parent_import_id;
    private ?int $parent_ref_id;
    private ?int $period_end;
    private ?int $period_start;
    private ?bool $period_time_indication;
    private ?int $ref_id;
    private ?bool $resources;
    private ?bool $send_welcome_email;
    private ?bool $show_members;
    private ?bool $show_members_participants_list;
    private ?string $syllabus;
    private ?bool $tag_cloud;
    private ?string $target_group;
    private ?string $title;
    private ?int $updated;
    private ?string $url;


    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $period_start = null,
        ?int $period_end = null,
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
        ?string $mail_to_members_type = null,
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
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;
        $dto->ref_id = $ref_id;
        $dto->created = $created;
        $dto->updated = $updated;
        $dto->parent_id = $parent_id;
        $dto->parent_import_id = $parent_import_id;
        $dto->parent_ref_id = $parent_ref_id;
        $dto->url = $url;
        $dto->icon_url = $icon_url;
        $dto->title = $title;
        $dto->description = $description;
        $dto->period_start = $period_start;
        $dto->period_end = $period_end;
        $dto->period_time_indication = $period_time_indication;
        $dto->online = $online;
        $dto->availability_start = $availability_start;
        $dto->availability_end = $availability_end;
        $dto->availability_always_visible = $availability_always_visible;
        $dto->calendar = $calendar;
        $dto->calendar_block = $calendar_block;
        $dto->news = $news;
        $dto->custom_metadata = $custom_metadata;
        $dto->tag_cloud = $tag_cloud;
        $dto->default_object_rating = $default_object_rating;
        $dto->badges = $badges;
        $dto->resources = $resources;
        $dto->mail_subject_prefix = $mail_subject_prefix;
        $dto->show_members = $show_members;
        $dto->show_members_participants_list = $show_members_participants_list;
        $dto->mail_to_members_type = $mail_to_members_type;
        $dto->send_welcome_email = $send_welcome_email;
        $dto->add_to_favourites = $add_to_favourites;
        $dto->important_information = $important_information;
        $dto->syllabus = $syllabus;
        $dto->target_group = $target_group;
        $dto->contact_name = $contact_name;
        $dto->contact_responsibility = $contact_responsibility;
        $dto->contact_phone = $contact_phone;
        $dto->contact_email = $contact_email;
        $dto->contact_consultation = $contact_consultation;
        $dto->didactic_template_id = $didactic_template_id;

        return $dto;
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


    public function getCreated() : ?int
    {
        return $this->created;
    }


    public function getDescription() : ?string
    {
        return $this->description;
    }


    public function getDidacticTemplateId() : ?int
    {
        return $this->didactic_template_id;
    }


    public function getIconUrl() : ?string
    {
        return $this->icon_url;
    }


    public function getId() : ?int
    {
        return $this->id;
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


    public function getMailToMembersType() : ?string
    {
        return $this->mail_to_members_type;
    }


    public function getParentId() : ?int
    {
        return $this->parent_id;
    }


    public function getParentImportId() : ?string
    {
        return $this->parent_import_id;
    }


    public function getParentRefId() : ?int
    {
        return $this->parent_ref_id;
    }


    public function getPeriodEnd() : ?int
    {
        return $this->period_end;
    }


    public function getPeriodStart() : ?int
    {
        return $this->period_start;
    }


    public function getRefId() : ?int
    {
        return $this->ref_id;
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


    public function getUpdated() : ?int
    {
        return $this->updated;
    }


    public function getUrl() : ?string
    {
        return $this->url;
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


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
