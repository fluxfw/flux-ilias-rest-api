<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;
use ilDBInterface;
use LogicException;

class GetUserCommand
{

    use UserQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getUserById(int $id) : ?UserDto
    {
        $user = null;
        while (($user_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getUserQuery(
                $id
            )))) !== null) {
            if ($user !== null) {
                throw new LogicException("Multiple users found with the id " . $id);
            }
            $user = $this->mapUserDto(
                $user_,
                $this->database->fetchAll($this->database->query($this->getUserAccessLimitedObjects(array_filter([$user_["time_limit_owner"]])))),
                $this->database->fetchAll($this->database->query($this->getUserMultiFieldQuery([$user_["usr_id"]]))),
                $this->database->fetchAll($this->database->query($this->getUserPreferenceQuery([$user_["usr_id"]]))),
                $this->database->fetchAll($this->database->query($this->getUserDefinedFieldQuery([$user_["usr_id"]])))
            );
        }

        return $user;
    }


    public function getUserByImportId(string $import_id) : ?UserDto
    {
        $user = null;
        while (($user_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getUserQuery(
                null,
                $import_id
            )))) !== null) {
            if ($user !== null) {
                throw new LogicException("Multiple users found with the import id " . $import_id);
            }
            $user = $this->mapUserDto(
                $user_,
                $this->database->fetchAll($this->database->query($this->getUserAccessLimitedObjects(array_filter([$user_["time_limit_owner"]])))),
                $this->database->fetchAll($this->database->query($this->getUserMultiFieldQuery([$user_["usr_id"]]))),
                $this->database->fetchAll($this->database->query($this->getUserPreferenceQuery([$user_["usr_id"]]))),
                $this->database->fetchAll($this->database->query($this->getUserDefinedFieldQuery([$user_["usr_id"]])))
            );
        }

        return $user;
    }
}
