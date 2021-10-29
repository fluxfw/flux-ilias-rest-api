<?php

namespace FluxIliasRestApi\Channel\User\Command;

use FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\User\UserQuery;

class UpdateUserCommand
{

    use UserQuery;

    private ObjectService $object;
    private UserService $user;


    public static function new(UserService $user, ObjectService $object) : /*static*/ self
    {
        $command = new static();

        $command->user = $user;
        $command->object = $object;

        return $command;
    }


    public function updateUserById(int $id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user->getUserById(
                $id
            ),
            $diff
        );
    }


    public function updateUserByImportId(string $import_id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user->getUserByImportId(
                $import_id
            ),
            $diff
        );
    }


    private function updateUser(?UserDto $user, UserDiffDto $diff) : ?UserIdDto
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

        $this->mapUserDiff(
            $diff,
            $ilias_user
        );

        $ilias_user->update();

        return UserIdDto::new(
            $user->getId(),
            $diff->getImportId() ?? $user->getImportId()
        );
    }
}
