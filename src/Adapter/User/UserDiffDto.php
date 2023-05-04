<?php

namespace FluxIliasRestApi\Adapter\User;

use SensitiveParameter;

class UserDiffDto
{

    /**
     * @param string[]|null              $general_interests
     * @param string[]|null              $offering_helps
     * @param string[]|null              $looking_for_helps
     * @param UserDefinedFieldDto[]|null $user_defined_fields
     */
    private function __construct(
        public readonly ?string $import_id,
        public readonly ?string $external_account,
        public readonly ?UserAuthenticationMode $authentication_mode,
        public readonly ?string $login,
        public readonly ?string $password,
        public readonly ?bool $active,
        public readonly ?bool $access_unlimited,
        public readonly ?int $access_limited_from,
        public readonly ?int $access_limited_until,
        public readonly ?int $access_limited_object_id,
        public readonly ?string $access_limited_object_import_id,
        public readonly ?int $access_limited_object_ref_id,
        public readonly ?bool $access_limited_message,
        public readonly ?UserGender $gender,
        public readonly ?string $first_name,
        public readonly ?string $last_name,
        public readonly ?string $title,
        public readonly ?int $birthday,
        public readonly ?string $institution,
        public readonly ?string $department,
        public readonly ?string $street,
        public readonly ?string $city,
        public readonly ?string $zip_code,
        public readonly ?string $country,
        public readonly ?UserSelectedCountry $selected_country,
        public readonly ?string $phone_office,
        public readonly ?string $phone_home,
        public readonly ?string $phone_mobile,
        public readonly ?string $fax,
        public readonly ?string $email,
        public readonly ?string $second_email,
        public readonly ?string $hobbies,
        public readonly ?string $heard_about_ilias,
        public readonly ?array $general_interests,
        public readonly ?array $offering_helps,
        public readonly ?array $looking_for_helps,
        public readonly ?string $matriculation_number,
        public readonly ?string $client_ip,
        public readonly ?string $location_latitude,
        public readonly ?string $location_longitude,
        public readonly ?int $location_zoom,
        public readonly ?array $user_defined_fields,
        public readonly ?UserLanguage $language
    ) {

    }


    /**
     * @param string[]|null              $general_interests
     * @param string[]|null              $offering_helps
     * @param string[]|null              $looking_for_helps
     * @param UserDefinedFieldDto[]|null $user_defined_fields
     */
    public static function new(
        ?string $import_id = null,
        ?string $external_account = null,
        ?UserAuthenticationMode $authentication_mode = null,
        ?string $login = null,
        #[SensitiveParameter] ?string $password = null,
        ?bool $active = null,
        ?bool $access_unlimited = null,
        ?int $access_limited_from = null,
        ?int $access_limited_until = null,
        ?int $access_limited_object_id = null,
        ?string $access_limited_object_import_id = null,
        ?int $access_limited_object_ref_id = null,
        ?bool $access_limited_message = null,
        ?UserGender $gender = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $title = null,
        ?int $birthday = null,
        ?string $institution = null,
        ?string $department = null,
        ?string $street = null,
        ?string $city = null,
        ?string $zip_code = null,
        ?string $country = null,
        ?UserSelectedCountry $selected_country = null,
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
        ?UserLanguage $language = null
    ) : static {
        return new static(
            $import_id,
            $external_account,
            $authentication_mode,
            $login,
            $password,
            $active,
            $access_unlimited,
            $access_limited_from,
            $access_limited_until,
            $access_limited_object_id,
            $access_limited_object_import_id,
            $access_limited_object_ref_id,
            $access_limited_message,
            $gender,
            $first_name,
            $last_name,
            $title,
            $birthday,
            $institution,
            $department,
            $street,
            $city,
            $zip_code,
            $country,
            $selected_country,
            $phone_office,
            $phone_home,
            $phone_mobile,
            $fax,
            $email,
            $second_email,
            $hobbies,
            $heard_about_ilias,
            $general_interests,
            $offering_helps,
            $looking_for_helps,
            $matriculation_number,
            $client_ip,
            $location_latitude,
            $location_longitude,
            $location_zoom,
            $user_defined_fields,
            $language
        );
    }


    public static function newFromObject(
        object $diff
    ) : static {
        return static::new(
            $diff->import_id ?? null,
            $diff->external_account ?? null,
            ($authentication_mode = $diff->authentication_mode ?? null) !== null ? UserAuthenticationMode::from($authentication_mode) : null,
            $diff->login ?? null,
            $diff->password ?? null,
            $diff->active ?? null,
            $diff->access_unlimited ?? null,
            $diff->access_limited_from ?? null,
            $diff->access_limited_until ?? null,
            $diff->access_limited_object_id ?? null,
            $diff->access_limited_object_import_id ?? null,
            $diff->access_limited_object_ref_id ?? null,
            $diff->access_limited_message ?? null,
            ($gender = $diff->gender ?? null) !== null ? UserGender::from($gender) : null,
            $diff->first_name ?? null,
            $diff->last_name ?? null,
            $diff->title ?? null,
            $diff->birthday ?? null,
            $diff->institution ?? null,
            $diff->department ?? null,
            $diff->street ?? null,
            $diff->city ?? null,
            $diff->zip_code ?? null,
            $diff->country ?? null,
            ($selected_country = $diff->selected_country ?? null) !== null ? UserSelectedCountry::from($selected_country) : null,
            $diff->phone_office ?? null,
            $diff->phone_home ?? null,
            $diff->phone_mobile ?? null,
            $diff->fax ?? null,
            $diff->email ?? null,
            $diff->second_email ?? null,
            $diff->hobbies ?? null,
            $diff->heard_about_ilias ?? null,
            $diff->general_interests ?? null,
            $diff->offering_helps ?? null,
            $diff->looking_for_helps ?? null,
            $diff->matriculation_number ?? null,
            $diff->client_ip ?? null,
            $diff->location_latitude ?? null,
            $diff->location_longitude ?? null,
            $diff->location_zoom ?? null,
            ($user_defined_fields = $diff->user_defined_fields ?? null) !== null ? array_map([UserDefinedFieldDto::class, "newFromObject"], $user_defined_fields) : null,
            ($language = $diff->language ?? null) !== null ? UserLanguage::from($language) : null
        );
    }
}
