<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User;

use Exception;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDefinedFieldDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\InternalObjectType;
use ilDBConstants;
use ilObjUser;
use ilUserDefinedFields;
use LogicException;

trait UserQuery
{

    private function getAccessLimitedObjects(array $ref_ids) : string
    {
        if (!empty($ref_ids)) {
            $where = $this->database->in("object_reference.ref_id", $ref_ids, false, ilDBConstants::T_INTEGER);
        } else {
            $where = "1!=1";
        }

        return "SELECT object_data.obj_id,import_id,object_reference.ref_id
FROM object_data
INNER JOIN object_reference ON object_data.obj_id=object_reference.obj_id
WHERE " . $where;
    }


    private function getIliasUser(int $id) : ?ilObjUser
    {
        return new ilObjUser($id);
    }


    private function getMultiFieldsQuery(array $ids) : string
    {
        return "SELECT usr_id,field_id,value
FROM usr_data_multi
WHERE " . $this->database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL AND value!=''";
    }


    private function getPreferencesQuery(array $ids) : string
    {
        return "SELECT usr_id,keyword,value
FROM usr_pref
WHERE " . $this->database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER) . " AND value IS NOT NULL AND value!=''";
    }


    private function getUserDefinedFieldsQuery(array $ids) : string
    {
        return "SELECT CASE WHEN udf_clob.usr_id IS NOT NULL THEN udf_clob.usr_id ELSE udf_text.usr_id END AS usr_id,field_name,udf_definition.field_id,CASE WHEN udf_clob.value IS NOT NULL THEN udf_clob.value ELSE udf_text.value END AS value
FROM udf_definition
LEFT JOIN udf_text ON udf_definition.field_id=udf_text.field_id
LEFT JOIN udf_clob ON udf_definition.field_id=udf_clob.field_id
HAVING " . $this->database->in("usr_id", $ids, false, ilDBConstants::T_INTEGER) . " AND value!=''";
    }


    private function getUsersQuery(?int $id = null, ?string $import_id = null) : string
    {
        $wheres = [
            "type=" . $this->database->quote(InternalObjectType::USR, ilDBConstants::T_TEXT)
        ];

        if ($id !== null) {
            $wheres[] = "usr_data.usr_id=" . $this->database->quote($id, ilDBConstants::T_INTEGER);
        }

        if ($import_id !== null) {
            $wheres[] = "import_id=" . $this->database->quote($import_id, ilDBConstants::T_TEXT);
        }

        return "SELECT usr_data.*,import_id
FROM usr_data
INNER JOIN object_data ON usr_data.usr_id=object_data.obj_id
WHERE " . implode(" AND ", $wheres) . "
ORDER BY login ASC";
    }


    private function mapDiff(UserDiffDto $diff, ilObjUser $ilias_user) : void
    {
        if ($diff->getImportId() !== null) {
            $ilias_user->setImportId($diff->getImportId());
        }

        if ($diff->getExternalAccount() !== null) {
            $ilias_user->setExternalAccount($diff->getExternalAccount());
        }

        if ($diff->getAuthenticationMode() !== null) {
            $ilias_user->setAuthMode(UserAuthenticationModeMapping::mapExternalToInternal($diff->getAuthenticationMode()));
        }

        if ($diff->getLogin() !== null) {
            $ilias_user->setLogin($diff->getLogin());
        }

        if ($diff->getPassword() !== null) {
            $ilias_user->setPasswd($diff->getPassword());
        }

        if ($diff->isActive() !== null) {
            $ilias_user->setActive($diff->isActive());
        }

        if ($diff->isAccessUnlimited() !== null) {
            $ilias_user->setTimeLimitUnlimited($diff->isAccessUnlimited());
        }

        if ($diff->getAccessLimitedFrom() !== null) {
            $ilias_user->setTimeLimitFrom($diff->getAccessLimitedFrom());
        }

        if ($diff->getAccessLimitedUntil() !== null) {
            $ilias_user->setTimeLimitUntil($diff->getAccessLimitedUntil());
        }

        if ($diff->getAccessLimitedObjectId() !== null) {
            $object = $this->object->getObjectById($diff->getAccessLimitedObjectId());
            if ($object === null) {
                throw new Exception("Access limited object id " . $diff->getAccessLimitedObjectId() . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->getRefId());
        }

        if ($diff->getAccessLimitedObjectImportId() !== null) {
            if ($diff->getAccessLimitedObjectId() !== null) {
                throw new LogicException("Can't set both access limited import id and object id");
            }

            $object = $this->object->getObjectByImportId($diff->getAccessLimitedObjectImportId());
            if ($object === null) {
                throw new Exception("Access limited object import id " . $diff->getAccessLimitedObjectImportId() . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->getRefId());
        }

        if ($diff->getAccessLimitedObjectRefId() !== null) {
            if ($diff->getAccessLimitedObjectId() !== null) {
                throw new LogicException("Can't set both access limited ref id and object id");
            }
            if ($diff->getAccessLimitedObjectImportId() !== null) {
                throw new LogicException("Can't set both access limited ref id and import id");
            }

            $object = $this->object->getObjectByRefId($diff->getAccessLimitedObjectRefId());
            if ($object === null) {
                throw new Exception("Access limited object ref id " . $diff->getAccessLimitedObjectRefId() . " not found");
            }

            $ilias_user->setTimeLimitOwner($object->getRefId());
        }

        if ($diff->isAccessLimitedMessage() !== null) {
            $ilias_user->setTimeLimitMessage($diff->isAccessLimitedMessage());
        }

        if ($diff->getGender() !== null) {
            $ilias_user->setGender(UserGenderMapping::mapExternalToInternal($diff->getGender()));
        }

        if ($diff->getFirstName() !== null) {
            $ilias_user->setFirstname($diff->getFirstName());
        }

        if ($diff->getLastName() !== null) {
            $ilias_user->setLastname($diff->getLastName());
        }

        if ($diff->getTitle() !== null) {
            $ilias_user->setUTitle($diff->getTitle());
        }

        /*if ($diff->getAvatar() !== null) {
            $ilias_user->setAvatar($diff->getAvatar());
        }*/

        if ($diff->getBirthday() !== null) {
            $ilias_user->setBirthday($diff->getBirthday());
        }

        if ($diff->getInstitution() !== null) {
            $ilias_user->setInstitution($diff->getInstitution());
        }

        if ($diff->getDepartment() !== null) {
            $ilias_user->setDepartment($diff->getDepartment());
        }

        if ($diff->getStreet() !== null) {
            $ilias_user->setStreet($diff->getStreet());
        }

        if ($diff->getCity() !== null) {
            $ilias_user->setCity($diff->getCity());
        }

        if ($diff->getZipCode() !== null) {
            $ilias_user->setZipcode($diff->getZipCode());
        }

        if ($diff->getCountry() !== null) {
            $ilias_user->setCountry($diff->getCountry());
        }

        if ($diff->getSelectedCountry() !== null) {
            $ilias_user->setSelectedCountry(UserSelectedCountryMapping::mapExternalToInternal($diff->getSelectedCountry()));
        }

        if ($diff->getPhoneOffice() !== null) {
            $ilias_user->setPhoneOffice($diff->getPhoneOffice());
        }

        if ($diff->getPhoneHome() !== null) {
            $ilias_user->setPhoneHome($diff->getPhoneHome());
        }

        if ($diff->getPhoneMobile() !== null) {
            $ilias_user->setPhoneMobile($diff->getPhoneMobile());
        }

        if ($diff->getFax() !== null) {
            $ilias_user->setFax($diff->getFax());
        }

        if ($diff->getEmail() !== null) {
            $ilias_user->setEmail($diff->getEmail());
        }

        if ($diff->getSecondEmail() !== null) {
            $ilias_user->setSecondEmail($diff->getSecondEmail());
        }

        if ($diff->getHobbies() !== null) {
            $ilias_user->setHobby($diff->getHobbies());
        }

        if ($diff->getHeardAboutIlias() !== null) {
            $ilias_user->setComment($diff->getHeardAboutIlias());
        }

        if ($diff->getGeneralInterests() !== null) {
            $ilias_user->setGeneralInterests($diff->getGeneralInterests());
        }

        if ($diff->getOfferingHelps() !== null) {
            $ilias_user->setOfferingHelp($diff->getOfferingHelps());
        }

        if ($diff->getLookingForHelps() !== null) {
            $ilias_user->setLookingForHelp($diff->getLookingForHelps());
        }

        if ($diff->getMatriculationNumber() !== null) {
            $ilias_user->setMatriculation($diff->getMatriculationNumber());
        }

        if ($diff->getClientIp() !== null) {
            $ilias_user->setClientIP($diff->getClientIp());
        }

        if ($diff->getLocationLatitude() !== null) {
            $ilias_user->setLatitude($diff->getLocationLatitude());
        }

        if ($diff->getLocationLongitude() !== null) {
            $ilias_user->setLongitude($diff->getLocationLongitude());
        }

        if ($diff->getLocationZoom() !== null) {
            $ilias_user->setLocationZoom($diff->getLocationZoom());
        }

        if ($diff->getUserDefinedFields() !== null) {
            $user_defined_data = [];
            $user_defined_field_name_id = null;

            foreach ($diff->getUserDefinedFields() as $user_defined_field) {
                if ($user_defined_field->getId() !== null) {
                    $user_defined_data[$user_defined_field->getId()] = $user_defined_field->getValue() ?? "";
                }

                if ($user_defined_field->getName() !== null) {
                    if ($user_defined_field->getId() !== null) {
                        throw new LogicException("Can't set both user defined field name and id");
                    }

                    $user_defined_field_name_id ??= array_reduce(ilUserDefinedFields::_getInstance()->getDefinitions(),
                        function (array $user_defined_field_name_id, array $user_defined_field) : array {
                            if (array_key_exists($user_defined_field["field_name"], $user_defined_field_name_id)) {
                                throw new LogicException("Multiple users defined fields " . $user_defined_field["field_name"] . " found");
                            }

                            $user_defined_field_name_id[$user_defined_field["field_name"]] = $user_defined_field["field_id"];

                            return $user_defined_field_name_id;
                        }, []);
                    if (!array_key_exists($user_defined_field->getName(), $user_defined_field_name_id)) {
                        throw new Exception("User defined field " . $user_defined_field->getName() . " does not exists");
                    }

                    $user_defined_data[$user_defined_field_name_id[$user_defined_field->getName()]] = $user_defined_field->getValue() ?? "";
                }
            }

            $ilias_user->setUserDefinedData($user_defined_data);
        }

        if ($diff->getLanguage() !== null) {
            $ilias_user->setLanguage(UserLanguageMapping::mapExternalToInternal($diff->getLanguage()));
        }

        $ilias_user->setTitle($ilias_user->getFullname());
        $ilias_user->setDescription($ilias_user->getEmail());
    }


    private function mapDto(array $user, ?array $access_limited_object_ids = null, ?array $multi_fields = null, ?array $preferences = null, ?array $user_defined_fields = null) : UserDto
    {
        $getAccessLimitedObjectId = fn(string $id) : ?string => $access_limited_object_ids !== null ? current(array_map(fn(array $access_limited_object_id) : ?string => $access_limited_object_id[$id]
            ?: null, array_filter($access_limited_object_ids, fn(array $access_limited_object_id) : bool => $access_limited_object_id["ref_id"] === $user["time_limit_owner"]))) : null;

        $getMultiField = fn(string $field) : ?array => $multi_fields !== null ? array_values(array_map(fn(array $multi_field) : string => $multi_field["value"],
            array_filter($multi_fields, fn(array $multi_field) : bool => $multi_field["usr_id"] === $user["usr_id"] && $multi_field["field_id"] === $field))) : null;

        $getPreference = fn(string $field) : ?string => $preferences !== null ? current(array_map(fn(array $preference) : string => $preference["value"],
            array_filter($preferences, fn(array $preference) : bool => $preference["usr_id"] === $user["usr_id"] && $preference["keyword"] === $field))) ?: null : null;

        return UserDto::new(
            $user["usr_id"] ?: null,
            $user["import_id"] ?: null,
            $user["ext_account"] ?: null,
            UserAuthenticationModeMapping::mapInternalToExternal($user["auth_mode"] ?? null),
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
            $getAccessLimitedObjectId("obj_id"),
            $getAccessLimitedObjectId("import_id"),
            $user["time_limit_owner"] ?: null,
            $user["time_limit_message"] ?? false,
            UserGenderMapping::mapInternalToExternal($user["gender"] ?? null),
            $user["firstname"] ?? "",
            $user["lastname"] ?? "",
            $user["title"] ?? "",
            strtotime($user["birthday"] ?? null) ?: null,
            $user["institution"] ?? "",
            $user["department"] ?? "",
            $user["street"] ?? "",
            $user["city"] ?? "",
            $user["zipcode"] ?? "",
            $user["country"] ?? "",
            UserSelectedCountryMapping::mapInternalToExternal($user["sel_country"] ?? null),
            $user["phone_office"] ?? "",
            $user["phone_home"] ?? "",
            $user["phone_mobile"] ?? "",
            $user["fax"] ?? "",
            $user["email"] ?? "",
            $user["second_email"] ?? "",
            $user["hobby"] ?? "",
            $user["referral_comment"] ?? "",
            $getMultiField("interests_general"),
            $getMultiField("interests_help_offered"),
            $getMultiField ("interests_help_looking"),
            $user["matriculation"] ?? "",
            $user["client_ip"] ?? "",
            $user["latitude"] ?? "",
            $user["longitude"] ?? "",
            $user["loc_zoom"] ?? 0,
            $user_defined_fields !== null ? array_values(array_map(fn(array $user_defined_field) : UserDefinedFieldDto => UserDefinedFieldDto::new(
                $user_defined_field["field_id"],
                $user_defined_field["field_name"],
                $user_defined_field["value"]
            ), array_filter($user_defined_fields, fn(array $user_defined_field) : bool => $user_defined_field["usr_id"] === $user["usr_id"]))) : null,
            UserLanguageMapping::mapInternalToExternal($getPreference("language"))
        );
    }


    private function newIliasUser() : ilObjUser
    {
        return new ilObjUser();
    }
}
