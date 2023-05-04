<?php

namespace FluxIliasRestApi\Service\User;

use Exception;
use FluxIliasRestApi\Adapter\User\UserAuthenticationMode;
use FluxIliasRestApi\Adapter\User\UserDefinedFieldDto;
use FluxIliasRestApi\Adapter\User\UserDiffDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\User\UserGender;
use FluxIliasRestApi\Service\Object\DefaultInternalObjectType;
use ilDBConstants;
use ilObjUser;
use ilUserDefinedFields;
use LogicException;

trait UserQuery
{

    private function getIliasUser(int $id) : ?ilObjUser
    {
        return new ilObjUser($id);
    }


    private function getUserAccessLimitedObjects(array $ref_ids) : string
    {
        return "SELECT object_data.obj_id,import_id,object_reference.ref_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
WHERE " . $this->ilias_database->in("object_reference.ref_id", $ref_ids, false, ilDBConstants::T_INTEGER);
    }


    private function getUserAvatarUrl(?string $profile_image) : ?string
    {
        if (empty($profile_image)) {
            return null;
        }

        return ILIAS_HTTP_PATH . "/" . ILIAS_WEB_DIR . "/" . CLIENT_ID . "/usr_images/" . $profile_image;
    }


    private function getUserDefinedFieldQuery(array $ids) : string
    {
        return "SELECT CASE WHEN udf_clob.usr_id IS NOT NULL THEN udf_clob.usr_id ELSE udf_text.usr_id END AS usr_id,field_name,udf_definition.field_id,CASE WHEN udf_clob.value IS NOT NULL THEN udf_clob.value ELSE udf_text.value END AS value
FROM udf_definition
LEFT JOIN udf_text ON udf_definition.field_id=udf_text.field_id
LEFT JOIN udf_clob ON udf_definition.field_id=udf_clob.field_id
HAVING " . $this->ilias_database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER);
    }


    private function getUserMultiFieldQuery(array $ids) : string
    {
        return "SELECT usr_id,field_id,value
FROM usr_data_multi
WHERE " . $this->ilias_database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL";
    }


    private function getUserPreferenceQuery(array $ids) : string
    {
        return "SELECT usr_id,keyword,value
FROM usr_pref
WHERE " . $this->ilias_database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL";
    }


    private function getUserQuery(
        ?int $id = null,
        ?string $import_id = null,
        ?string $external_account = null,
        ?string $login = null,
        ?string $email = null,
        ?string $matriculation_number = null
    ) : string {
        $wheres = [
            "type=" . $this->ilias_database->quote(DefaultInternalObjectType::USR->value, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "usr_data.usr_id=" . $this->ilias_database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "import_id=" . $this->ilias_database->quote($import_id, ilDBConstants::T_TEXT);
        }

        if ($external_account !== null) {
            $wheres[] = "usr_data.ext_account=" . $this->ilias_database->quote($external_account, ilDBConstants::T_TEXT);
        }

        if ($login !== null) {
            $wheres[] = "usr_data.login=" . $this->ilias_database->quote($login, ilDBConstants::T_TEXT);
        }

        if ($email !== null) {
            $wheres[] = "usr_data.email=" . $this->ilias_database->quote($email, ilDBConstants::T_TEXT);
        }

        if ($matriculation_number !== null) {
            $wheres[] = "usr_data.matriculation=" . $this->ilias_database->quote($matriculation_number, ilDBConstants::T_TEXT);
        }

        return "SELECT usr_data.*,import_id
FROM usr_data
INNER JOIN object_data ON usr_data.usr_id=object_data.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY login ASC";
    }


    private function getUserSessionQuery(string $session_id) : string
    {
        return "SELECT user_id
FROM usr_session
WHERE session_id=" . $this->ilias_database->quote($session_id,
                ilDBConstants::T_TEXT);
    }


    private function mapUserDiff(UserDiffDto $diff, ilObjUser $ilias_user) : void
    {
        if ($diff->import_id !== null) {
            $ilias_user->setImportId($diff->import_id);
        }

        if ($diff->external_account !== null) {
            $ilias_user->setExternalAccount($diff->external_account);
        }

        if ($diff->authentication_mode !== null) {
            $ilias_user->setAuthMode(UserAuthenticationModeMapping::mapExternalToInternal($diff->authentication_mode)->value);
        }

        if ($diff->login !== null) {
            $ilias_user->updateLogin($diff->login);
        }

        if ($diff->password !== null) {
            $ilias_user->setPasswd($diff->password);
        }

        if ($diff->active !== null) {
            $ilias_user->setActive($diff->active);
        }

        if ($diff->access_unlimited !== null) {
            $ilias_user->setTimeLimitUnlimited($diff->access_unlimited);
        }

        if ($diff->access_limited_from !== null) {
            $ilias_user->setTimeLimitFrom($diff->access_limited_from);
        }

        if ($diff->access_limited_until !== null) {
            $ilias_user->setTimeLimitUntil($diff->access_limited_until);
        }

        if ($diff->access_limited_object_id !== null) {
            $object = $this->object_service->getObjectById(
                $diff->access_limited_object_id,
                false
            );
            if ($object === null) {
                throw new Exception("Access limited object id " . $diff->access_limited_object_id . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->ref_id);
        }

        if ($diff->access_limited_object_import_id !== null) {
            if ($diff->access_limited_object_id !== null) {
                throw new LogicException("Can't set both access limited import id and object id");
            }

            $object = $this->object_service->getObjectByImportId(
                $diff->access_limited_object_import_id,
                false
            );
            if ($object === null) {
                throw new Exception("Access limited object import id " . $diff->access_limited_object_import_id . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->ref_id);
        }

        if ($diff->access_limited_object_ref_id !== null) {
            if ($diff->access_limited_object_id !== null) {
                throw new LogicException("Can't set both access limited ref id and object id");
            }
            if ($diff->access_limited_object_import_id !== null) {
                throw new LogicException("Can't set both access limited ref id and import id");
            }

            $object = $this->object_service->getObjectByRefId(
                $diff->access_limited_object_ref_id,
                false
            );
            if ($object === null) {
                throw new Exception("Access limited object ref id " . $diff->access_limited_object_ref_id . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->ref_id);
        }

        if ($diff->access_limited_message !== null) {
            $ilias_user->setTimeLimitMessage($diff->access_limited_message);
        }

        if ($diff->gender !== null) {
            $ilias_user->setGender(UserGenderMapping::mapExternalToInternal($diff->gender)->value);
        }

        if ($diff->first_name !== null) {
            $ilias_user->setFirstname($diff->first_name);
        }

        if ($diff->last_name !== null) {
            $ilias_user->setLastname($diff->last_name);
        }

        if ($diff->title !== null) {
            $ilias_user->setUTitle($diff->title);
        }

        if ($diff->birthday !== null) {
            $ilias_user->setBirthday(date("Y-m-d", $diff->birthday));
        }

        if ($diff->birthday_unset !== null) {
            if ($diff->birthday !== null) {
                throw new LogicException("Can't both set and unset birthday");
            }

            if ($diff->birthday_unset) {
                $ilias_user->setBirthday(null);
            }
        }

        if ($diff->institution !== null) {
            $ilias_user->setInstitution($diff->institution);
        }

        if ($diff->department !== null) {
            $ilias_user->setDepartment($diff->department);
        }

        if ($diff->street !== null) {
            $ilias_user->setStreet($diff->street);
        }

        if ($diff->city !== null) {
            $ilias_user->setCity($diff->city);
        }

        if ($diff->zip_code !== null) {
            $ilias_user->setZipcode($diff->zip_code);
        }

        if ($diff->country !== null) {
            $ilias_user->setCountry($diff->country);
        }

        if ($diff->selected_country !== null) {
            $ilias_user->setSelectedCountry(UserSelectedCountryMapping::mapExternalToInternal($diff->selected_country)->value);
        }

        if ($diff->phone_office !== null) {
            $ilias_user->setPhoneOffice($diff->phone_office);
        }

        if ($diff->phone_home !== null) {
            $ilias_user->setPhoneHome($diff->phone_home);
        }

        if ($diff->phone_mobile !== null) {
            $ilias_user->setPhoneMobile($diff->phone_mobile);
        }

        if ($diff->fax !== null) {
            $ilias_user->setFax($diff->fax);
        }

        if ($diff->email !== null) {
            $ilias_user->setEmail($diff->email);
        }

        if ($diff->second_email !== null) {
            $ilias_user->setSecondEmail($diff->second_email);
        }

        if ($diff->hobbies !== null) {
            $ilias_user->setHobby($diff->hobbies);
        }

        if ($diff->heard_about_ilias !== null) {
            $ilias_user->setComment($diff->heard_about_ilias);
        }

        if ($diff->general_interests !== null) {
            $ilias_user->setGeneralInterests($diff->general_interests);
        }

        if ($diff->offering_helps !== null) {
            $ilias_user->setOfferingHelp($diff->offering_helps);
        }

        if ($diff->looking_for_helps !== null) {
            $ilias_user->setLookingForHelp($diff->looking_for_helps);
        }

        if ($diff->matriculation_number !== null) {
            $ilias_user->setMatriculation($diff->matriculation_number);
        }

        if ($diff->client_ip !== null) {
            $ilias_user->setClientIP($diff->client_ip);
        }

        if ($diff->location_latitude !== null) {
            $ilias_user->setLatitude($diff->location_latitude);
        }

        if ($diff->location_longitude !== null) {
            $ilias_user->setLongitude($diff->location_longitude);
        }

        if ($diff->location_zoom !== null) {
            $ilias_user->setLocationZoom($diff->location_zoom);
        }

        if ($diff->user_defined_fields !== null) {
            $user_defined_data = [];
            $user_defined_field_name_id = null;

            foreach ($diff->user_defined_fields as $user_defined_field) {
                if ($user_defined_field->id !== null) {
                    $user_defined_data[$user_defined_field->id] = $user_defined_field->value ?? "";
                }

                if ($user_defined_field->name !== null) {
                    if ($user_defined_field->id !== null) {
                        throw new LogicException("Can't set both user defined field name and field id");
                    }

                    $user_defined_field_name_id ??= array_reduce(ilUserDefinedFields::_getInstance()->getDefinitions(),
                        function (array $user_defined_field_name_id, array $user_defined_field) : array {
                            if (array_key_exists($user_defined_field["field_name"], $user_defined_field_name_id)) {
                                throw new LogicException("Multiple users defined field names " . $user_defined_field["field_name"] . " found");
                            }

                            $user_defined_field_name_id[$user_defined_field["field_name"]] = $user_defined_field["field_id"];

                            return $user_defined_field_name_id;
                        }, []);
                    if (!array_key_exists($user_defined_field->name, $user_defined_field_name_id)) {
                        throw new Exception("User defined field name " . $user_defined_field->name . " does not exists");
                    }

                    $user_defined_data[$user_defined_field_name_id[$user_defined_field->name]] = $user_defined_field->value ?? "";
                }
            }

            $ilias_user->setUserDefinedData($user_defined_data);
        }

        if ($diff->language !== null) {
            $ilias_user->setLanguage(UserLanguageMapping::mapExternalToInternal($diff->language)->value);
        }

        $ilias_user->setTitle($ilias_user->getFullname());
        $ilias_user->setDescription($ilias_user->getEmail());
    }


    private function mapUserDto(array $user, ?array $access_limited_object_ids = null, ?array $multi_fields = null, ?array $preferences = null, ?array $user_defined_fields = null) : UserDto
    {
        $getUserAccessLimitedObjectId = fn(string $id) : mixed => $access_limited_object_ids !== null ? current(array_map(fn(array $access_limited_object_id
        ) : mixed => $access_limited_object_id[$id] ?: null,
            array_filter($access_limited_object_ids, fn(array $access_limited_object_id) : bool => $access_limited_object_id["ref_id"] === $user["time_limit_owner"]))) : null;

        $getUserMultiField = fn(string $field) : ?array => $multi_fields !== null ? array_values(array_map(fn(array $multi_field) : mixed => $multi_field["value"],
            array_filter($multi_fields, fn(array $multi_field) : bool => $multi_field["usr_id"] === $user["usr_id"] && $multi_field["field_id"] === $field))) : null;

        $getUserPreference = fn(string $field) : mixed => $preferences !== null ? current(array_map(fn(array $preference) : mixed => $preference["value"],
            array_filter($preferences, fn(array $preference) : bool => $preference["usr_id"] === $user["usr_id"] && $preference["keyword"] === $field))) : null;

        return UserDto::new(
            $user["usr_id"] ?: null,
            $user["import_id"] ?: null,
            $user["ext_account"] ?: null,
            ($authentication_mode = $user["auth_mode"] ?: null) !== null ? UserAuthenticationModeMapping::mapInternalToExternal(InternalUserAuthenticationMode::from($authentication_mode))
                : UserAuthenticationMode::DEFAULT,
            $user["login"] ?? "",
            strtotime($user["create_date"] ?? null) ?: null,
            strtotime($user["last_update"] ?? null) ?: null,
            strtotime($user["approve_date"] ?? null) ?: null,
            strtotime($user["agree_date"] ?? null) ?: null,
            strtotime($user["last_login"] ?? null) ?: null,
            $user["active"] ?? false,
            $user["time_limit_unlimited"] ?? false,
            strtotime($user["time_limit_from"] ?? null) ?: null,
            strtotime($user["time_limit_until"] ?? null) ?: null,
            $getUserAccessLimitedObjectId(
                "obj_id"
            ),
            $getUserAccessLimitedObjectId(
                "import_id"
            ),
            $user["time_limit_owner"] ?: null,
            $user["time_limit_message"] ?? false,
            ($gender = $user["gender"] ?: null) !== null ? UserGenderMapping::mapInternalToExternal(InternalUserGender::from($gender)) : UserGender::NONE,
            $user["firstname"] ?? "",
            $user["lastname"] ?? "",
            $user["title"] ?? "",
            $this->getUserAvatarUrl(
                $getUserPreference(
                    "profile_image"
                )
            ),
            strtotime($user["birthday"] ?? null) ?: null,
            $user["institution"] ?? "",
            $user["department"] ?? "",
            $user["street"] ?? "",
            $user["city"] ?? "",
            $user["zipcode"] ?? "",
            $user["country"] ?? "",
            ($selected_country = $user["sel_country"] ?: null) !== null ? UserSelectedCountryMapping::mapInternalToExternal(InternalUserSelectedCountry::from($selected_country)) : null,
            $user["phone_office"] ?? "",
            $user["phone_home"] ?? "",
            $user["phone_mobile"] ?? "",
            $user["fax"] ?? "",
            $user["email"] ?? "",
            $user["second_email"] ?? "",
            $user["hobby"] ?? "",
            $user["referral_comment"] ?? "",
            $getUserMultiField(
                "interests_general"
            ),
            $getUserMultiField(
                "interests_help_offered"
            ),
            $getUserMultiField(
                "interests_help_looking"
            ),
            $user["matriculation"] ?? "",
            $user["client_ip"] ?? "",
            $user["latitude"] ?? "",
            $user["longitude"] ?? "",
            $user["loc_zoom"] ?? 0,
            $user_defined_fields !== null ? array_values(array_map(fn(array $user_defined_field) : UserDefinedFieldDto => UserDefinedFieldDto::new(
                $user_defined_field["field_id"] ?: null,
                $user_defined_field["field_name"] ?? null,
                $user_defined_field["value"] ?? null
            ), array_filter($user_defined_fields, fn(array $user_defined_field) : bool => $user_defined_field["usr_id"] === $user["usr_id"]))) : null,
            ($language = $getUserPreference("language") ?: null) !== null ? UserLanguageMapping::mapInternalToExternal(InternalUserLanguage::from($language)) : null
        );
    }


    private function newIliasUser() : ilObjUser
    {
        return new ilObjUser();
    }
}
