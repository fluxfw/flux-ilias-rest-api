<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;
use ilObjUser;

class UpdateAvatarCommand
{

    use UserQuery;

    private UserService $user;


    public static function new(UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->user = $user;

        return $command;
    }


    public function updateAvatarById(int $id, ?string $file) : ?UserIdDto
    {
        return $this->updateAvatar(
            $this->user->getUserById(
                $id
            ),
            $file
        );
    }


    public function updateAvatarByImportId(string $import_id, ?string $file) : ?UserIdDto
    {
        return $this->updateAvatar(
            $this->user->getUserByImportId(
                $import_id
            ),
            $file
        );
    }


    private function updateAvatar(?UserDto $user, ?string $file) : ?UserIdDto
    {
        if ($user === null) {
            return null;
        }

        if ($file !== null) {
            ilObjUser::_uploadPersonalPicture($file, $user->getId());
        } else {
            $ilias_user = $this->getIliasUser(
                $user->getId()
            );
            if ($ilias_user === null) {
                return null;
            }

            $ilias_user->removeUserPicture();
        }

        return UserIdDto::new(
            $user->getId(),
            $user->getImportId()
        );
    }
}
