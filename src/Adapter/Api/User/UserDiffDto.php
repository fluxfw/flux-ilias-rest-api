<?php

namespace FluxIliasRestApi\Adapter\Api\User;

class UserDiffDto
{

    private ?int $access_limited_from;
    private ?bool $access_limited_message;
    private ?int $access_limited_object_id;
    private ?string $access_limited_object_import_id;
    private ?int $access_limited_object_ref_id;
    private ?int $access_limited_until;
    private ?bool $access_unlimited;
    private ?bool $active;
    private ?string $authentication_mode;
    private ?string $birthday;
    private ?string $city;
    private ?string $client_ip;
    private ?string $country;
    private ?string $department;
    private ?string $email;
    private ?string $external_account;
    private ?string $fax;
    private ?string $first_name;
    private ?string $gender;
    private ?array $general_interests;
    private ?string $heard_about_ilias;
    private ?string $hobbies;
    private ?string $import_id;
    private ?string $institution;
    private ?string $language;
    private ?string $last_name;
    private ?string $location_latitude;
    private ?string $location_longitude;
    private ?int $location_zoom;
    private ?string $login;
    private ?array $looking_for_helps;
    private ?string $matriculation_number;
    private ?array $offering_helps;
    private ?string $password;
    private ?string $phone_home;
    private ?string $phone_mobile;
    private ?string $phone_office;
    private ?string $second_email;
    private ?string $selected_country;
    private ?string $street;
    private ?string $title;
    private ?array $user_defined_fields;
    private ?string $zip_code;


    public static function newFromData(object $data) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->external_account ?? null,
            $data->authentication_mode ?? null,
            $data->login ?? null,
            $data->password ?? null,
            $data->active ?? null,
            $data->access_unlimited ?? null,
            $data->access_limited_from ?? null,
            $data->access_limited_until ?? null,
            $data->access_limited_object_id ?? null,
            $data->access_limited_object_import_id ?? null,
            $data->access_limited_object_ref_id ?? null,
            $data->access_limited_message ?? null,
            $data->gender ?? null,
            $data->first_name ?? null,
            $data->last_name ?? null,
            $data->title ?? null,
            $data->birthday ?? null,
            $data->institution ?? null,
            $data->department ?? null,
            $data->street ?? null,
            $data->city ?? null,
            $data->zip_code ?? null,
            $data->country ?? null,
            $data->selected_country ?? null,
            $data->phone_office ?? null,
            $data->phone_home ?? null,
            $data->phone_mobile ?? null,
            $data->fax ?? null,
            $data->email ?? null,
            $data->second_email ?? null,
            $data->hobbies ?? null,
            $data->heard_about_ilias ?? null,
            $data->general_interests ?? null,
            $data->offering_helps ?? null,
            $data->looking_for_helps ?? null,
            $data->matriculation_number ?? null,
            $data->client_ip ?? null,
            $data->location_latitude ?? null,
            $data->location_longitude ?? null,
            $data->location_zoom ?? null,
            ($user_defined_fields = $data->user_defined_fields ?? null) !== null ? array_map(fn(object $user_defined_field
            ) : UserDefinedFieldDto => UserDefinedFieldDto::new(
                $user_defined_field->id ?? null,
                $user_defined_field->name ?? null,
                $user_defined_field->value ?? null
            ), $user_defined_fields) : null,
            $data->language ?? null
        );
    }


    private static function new(
        ?string $import_id = null,
        ?string $external_account = null,
        ?string $authentication_mode = null,
        ?string $login = null,
        ?string $password = null,
        ?bool $active = null,
        ?bool $access_unlimited = null,
        ?int $access_limited_from = null,
        ?int $access_limited_until = null,
        ?int $access_limited_object_id = null,
        ?string $access_limited_object_import_id = null,
        ?int $access_limited_object_ref_id = null,
        ?bool $access_limited_message = null,
        ?string $gender = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $title = null,
        ?string $birthday = null,
        ?string $institution = null,
        ?string $department = null,
        ?string $street = null,
        ?string $city = null,
        ?string $zip_code = null,
        ?string $country = null,
        ?string $selected_country = null,
        ?string $phone_office = null,
        ?string $phone_home = null,
        ?string $phone_mobile = null,
        ?string $fax = null,
        ?string $email = null,
        ?string $second_email = null,
        ?string $hobbies = null,
        ?string $heard_about_ilias = null,
        ?array $general_interests = null,
        ?array $offering_helps = null,
        ?array $looking_for_helps = null,
        ?string $matriculation_number = null,
        ?string $client_ip = null,
        ?string $location_latitude = null,
        ?string $location_longitude = null,
        ?int $location_zoom = null,
        ?array $user_defined_fields = null,
        ?string $language = null
    ) : /*static*/ self
    {
        $dto = new static();

        $dto->import_id = $import_id;
        $dto->external_account = $external_account;
        $dto->authentication_mode = $authentication_mode;
        $dto->login = $login;
        $dto->password = $password;
        $dto->active = $active;
        $dto->access_unlimited = $access_unlimited;
        $dto->access_limited_from = $access_limited_from;
        $dto->access_limited_until = $access_limited_until;
        $dto->access_limited_object_id = $access_limited_object_id;
        $dto->access_limited_object_import_id = $access_limited_object_import_id;
        $dto->access_limited_object_ref_id = $access_limited_object_ref_id;
        $dto->access_limited_message = $access_limited_message;
        $dto->gender = $gender;
        $dto->first_name = $first_name;
        $dto->last_name = $last_name;
        $dto->title = $title;
        $dto->birthday = $birthday;
        $dto->institution = $institution;
        $dto->department = $department;
        $dto->street = $street;
        $dto->city = $city;
        $dto->zip_code = $zip_code;
        $dto->country = $country;
        $dto->selected_country = $selected_country;
        $dto->phone_office = $phone_office;
        $dto->phone_home = $phone_home;
        $dto->phone_mobile = $phone_mobile;
        $dto->fax = $fax;
        $dto->email = $email;
        $dto->second_email = $second_email;
        $dto->hobbies = $hobbies;
        $dto->heard_about_ilias = $heard_about_ilias;
        $dto->general_interests = $general_interests;
        $dto->offering_helps = $offering_helps;
        $dto->looking_for_helps = $looking_for_helps;
        $dto->matriculation_number = $matriculation_number;
        $dto->client_ip = $client_ip;
        $dto->location_latitude = $location_latitude;
        $dto->location_longitude = $location_longitude;
        $dto->location_zoom = $location_zoom;
        $dto->user_defined_fields = $user_defined_fields;
        $dto->language = $language;

        return $dto;
    }


    public function getAccessLimitedFrom() : ?int
    {
        return $this->access_limited_from;
    }


    public function getAccessLimitedObjectId() : ?int
    {
        return $this->access_limited_object_id;
    }


    public function getAccessLimitedObjectImportId() : ?string
    {
        return $this->access_limited_object_import_id;
    }


    public function getAccessLimitedObjectRefId() : ?int
    {
        return $this->access_limited_object_ref_id;
    }


    public function getAccessLimitedUntil() : ?int
    {
        return $this->access_limited_until;
    }


    public function getAuthenticationMode() : ?string
    {
        return $this->authentication_mode;
    }


    public function getBirthday() : ?string
    {
        return $this->birthday;
    }


    public function getCity() : ?string
    {
        return $this->city;
    }


    public function getClientIp() : ?string
    {
        return $this->client_ip;
    }


    public function getCountry() : ?string
    {
        return $this->country;
    }


    public function getDepartment() : ?string
    {
        return $this->department;
    }


    public function getEmail() : ?string
    {
        return $this->email;
    }


    public function getExternalAccount() : ?string
    {
        return $this->external_account;
    }


    public function getFax() : ?string
    {
        return $this->fax;
    }


    public function getFirstName() : ?string
    {
        return $this->first_name;
    }


    public function getGender() : ?string
    {
        return $this->gender;
    }


    public function getGeneralInterests() : ?array
    {
        return $this->general_interests;
    }


    public function getHeardAboutIlias() : ?string
    {
        return $this->heard_about_ilias;
    }


    public function getHobbies() : ?string
    {
        return $this->hobbies;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function getInstitution() : ?string
    {
        return $this->institution;
    }


    public function getLanguage() : ?string
    {
        return $this->language;
    }


    public function getLastName() : ?string
    {
        return $this->last_name;
    }


    public function getLocationLatitude() : ?string
    {
        return $this->location_latitude;
    }


    public function getLocationLongitude() : ?string
    {
        return $this->location_longitude;
    }


    public function getLocationZoom() : ?int
    {
        return $this->location_zoom;
    }


    public function getLogin() : ?string
    {
        return $this->login;
    }


    public function getLookingForHelps() : ?array
    {
        return $this->looking_for_helps;
    }


    public function getMatriculationNumber() : ?string
    {
        return $this->matriculation_number;
    }


    public function getOfferingHelps() : ?array
    {
        return $this->offering_helps;
    }


    public function getPassword() : ?string
    {
        return $this->password;
    }


    public function getPhoneHome() : ?string
    {
        return $this->phone_home;
    }


    public function getPhoneMobile() : ?string
    {
        return $this->phone_mobile;
    }


    public function getPhoneOffice() : ?string
    {
        return $this->phone_office;
    }


    public function getSecondEmail() : ?string
    {
        return $this->second_email;
    }


    public function getSelectedCountry() : ?string
    {
        return $this->selected_country;
    }


    public function getStreet() : ?string
    {
        return $this->street;
    }


    public function getTitle() : ?string
    {
        return $this->title;
    }


    public function getUserDefinedFields() : ?array
    {
        return $this->user_defined_fields;
    }


    public function getZipCode() : ?string
    {
        return $this->zip_code;
    }


    public function isAccessLimitedMessage() : ?bool
    {
        return $this->access_limited_message;
    }


    public function isAccessUnlimited() : ?bool
    {
        return $this->access_unlimited;
    }


    public function isActive() : ?bool
    {
        return $this->active;
    }
}
