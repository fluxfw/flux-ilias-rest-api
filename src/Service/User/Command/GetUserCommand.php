<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\User\UserQuery;
use ilDBInterface;
use LogicException;

class GetUserCommand
{

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


    public function getUserById(int $id) : ?UserDto
    {
        $user = null;
        while (($user_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getUserQuery(
                $id
            )))) !== null) {
            if ($user !== null) {
                throw new LogicException("Multiple users found with the id " . $id);
            }
            $user = $this->mapUserDto(
                $user_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserAccessLimitedObjects(array_filter([$user_["time_limit_owner"]])))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserMultiFieldQuery([$user_["usr_id"]]))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserPreferenceQuery([$user_["usr_id"]]))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserDefinedFieldQuery([$user_["usr_id"]])))
            );
        }

        return $user;
    }


    public function getUserByImportId(string $import_id) : ?UserDto
    {
        $user = null;
        while (($user_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getUserQuery(
                null,
                $import_id
            )))) !== null) {
            if ($user !== null) {
                throw new LogicException("Multiple users found with the import id " . $import_id);
            }
            $user = $this->mapUserDto(
                $user_,
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserAccessLimitedObjects(array_filter([$user_["time_limit_owner"]])))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserMultiFieldQuery([$user_["usr_id"]]))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserPreferenceQuery([$user_["usr_id"]]))),
                $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserDefinedFieldQuery([$user_["usr_id"]])))
            );
        }

        return $user;
    }
}
