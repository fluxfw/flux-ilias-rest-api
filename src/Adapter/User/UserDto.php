<?php

namespace FluxIliasRestApi\Adapter\User;

class UserDto
{

    /**
     * @param string[]|null              $general_interests
     * @param string[]|null              $offering_helps
     * @param string[]|null              $looking_for_helps
     * @param UserDefinedFieldDto[]|null $user_defined_fields
     */
    private function __construct(
        public readonly ?int $id,
        public readonly ?string $import_id,
        public readonly ?string $external_account,
        public readonly ?UserAuthenticationMode $authentication_mode,
        public readonly ?string $login,
        public readonly ?float $created_on,
        public readonly ?float $updated_on,
        public readonly ?float $approved_on,
        public readonly ?float $agreed_on,
        public readonly ?float $last_logged_on,
        public readonly ?bool $active,
        public readonly ?bool $access_unlimited,
        public readonly ?float $access_limited_from,
        public readonly ?float $access_limited_until,
        public readonly ?int $access_limited_object_id,
        public readonly ?string $access_limited_object_import_id,
        public readonly ?int $access_limited_object_ref_id,
        public readonly ?bool $access_limited_message,
        public readonly ?UserGender $gender,
        public readonly ?string $first_name,
        public readonly ?string $last_name,
        public readonly ?string $title,
        public readonly ?string $avatar_url,
        public readonly ?float $birthday,
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
        ?int $id = null,
        ?string $import_id = null,
        ?string $external_account = null,
        ?UserAuthenticationMode $authentication_mode = null,
        ?string $login = null,
        ?float $created_on = null,
        ?float $updated_on = null,
        ?float $approved_on = null,
        ?float $agreed_on = null,
        ?float $last_logged_on = null,
        ?bool $active = null,
        ?bool $access_unlimited = null,
        ?float $access_limited_from = null,
        ?float $access_limited_until = null,
        ?int $access_limited_object_id = null,
        ?string $access_limited_object_import_id = null,
        ?int $access_limited_object_ref_id = null,
        ?bool $access_limited_message = null,
        ?UserGender $gender = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $title = null,
        ?string $avatar_url = null,
        ?float $birthday = null,
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
            $id,
            $import_id,
            $external_account,
            $authentication_mode,
            $login,
            $created_on,
            $updated_on,
            $approved_on,
            $agreed_on,
            $last_logged_on,
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
            $avatar_url,
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
        object $user
    ) : static {
        return static::new(
            $user->id ?? null,
            $user->import_id ?? null,
            $user->external_account ?? null,
            ($authentication_mode = $user->authentication_mode ?? null) !== null ? UserAuthenticationMode::from($authentication_mode) : null,
            $user->login ?? null,
            $user->created_on ?? null,
            $user->updated_on ?? null,
            $user->approved_on ?? null,
            $user->agreed_on ?? null,
            $user->last_logged_on ?? null,
            $user->active ?? null,
            $user->access_unlimited ?? null,
            $user->access_limited_from ?? null,
            $user->access_limited_until ?? null,
            $user->access_limited_object_id ?? null,
            $user->access_limited_object_import_id ?? null,
            $user->access_limited_object_ref_id ?? null,
            $user->access_limited_message ?? null,
            ($gender = $user->gender ?? null) !== null ? UserGender::from($gender) : null,
            $user->first_name ?? null,
            $user->last_name ?? null,
            $user->title ?? null,
            $user->avatar_url ?? null,
            $user->birthday ?? null,
            $user->institution ?? null,
            $user->department ?? null,
            $user->street ?? null,
            $user->city ?? null,
            $user->zip_code ?? null,
            $user->country ?? null,
            ($selected_country = $user->selected_country ?? null) !== null ? UserSelectedCountry::from($selected_country) : null,
            $user->phone_office ?? null,
            $user->phone_home ?? null,
            $user->phone_mobile ?? null,
            $user->fax ?? null,
            $user->email ?? null,
            $user->second_email ?? null,
            $user->hobbies ?? null,
            $user->heard_about_ilias ?? null,
            $user->general_interests ?? null,
            $user->offering_helps ?? null,
            $user->looking_for_helps ?? null,
            $user->matriculation_number ?? null,
            $user->client_ip ?? null,
            $user->location_latitude ?? null,
            $user->location_longitude ?? null,
            $user->location_zoom ?? null,
            ($user_defined_fields = $user->user_defined_fields ?? null) !== null ? array_map([UserDefinedFieldDto::class, "newFromObject"], $user_defined_fields) : null,
            ($language = $user->language ?? null) !== null ? UserLanguage::from($language) : null
        );
    }
}
