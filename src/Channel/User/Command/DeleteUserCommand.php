<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;

class DeleteUserCommand
{

    use UserQuery;

    private UserService $user;


    public static function new(UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->user = $user;

        return $command;
    }


    public function deleteUserById(int $id) : ?UserIdDto
    {
        return $this->deleteUser(
            $this->user->getUserById(
                $id
            )
        );
    }


    public function deleteUserByImportId(string $import_id) : ?UserIdDto
    {
        return $this->deleteUser(
            $this->user->getUserByImportId(
                $import_id
            )
        );
    }


    private function deleteUser(?UserDto $user) : ?UserIdDto
    {
        if ($user === null) {
            return null;
        }

        $ilias_user = $this->getIliasUser(
            $user->getId()
        );
        if ($ilias_user === null) {
            return null;
        }

        $ilias_user->delete();

        return UserIdDto::new(
            $user->getId(),
            $user->getImportId()
        );
    }
}
