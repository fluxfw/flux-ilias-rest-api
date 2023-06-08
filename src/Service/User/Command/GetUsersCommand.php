<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\Timestamp\TimestampQuery;
use FluxIliasRestApi\Service\User\UserQuery;
use ilDBInterface;

class GetUsersCommand
{

    use TimestampQuery;
    use UserQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return UserDto[]
     */
    public function getUsers(
        ?string $external_account = null,
        ?string $login = null,
        ?string $email = null,
        ?string $matriculation_number = null,
        bool $access_limited_object_ids = false,
        bool $multi_fields = false,
        bool $preferences = false,
        bool $user_defined_fields = false
    ) : array {
        $users = $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserQuery(
            null,
            null,
            $external_account,
            $login,
            $email,
            $matriculation_number
        )));
        $user_ids = array_map(fn(array $user) : int => $user["usr_id"], $users);

        $access_limited_object_ids_ = $access_limited_object_ids ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserAccessLimitedObjects(array_filter(array_map(fn(array $user
        ) : int => $user["time_limit_owner"], $users))))) : null;

        $multi_fields_ = $multi_fields ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserMultiFieldQuery($user_ids))) : null;

        $preferences_ = $preferences ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserPreferenceQuery($user_ids))) : null;

        $user_defined_fields_ = $user_defined_fields ? $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserDefinedFieldQuery($user_ids))) : null;

        return array_map(fn(array $user) : UserDto => $this->mapUserDto(
            $user,
            $access_limited_object_ids_,
            $multi_fields_,
            $preferences_,
            $user_defined_fields_
        ), $users);
    }
}
