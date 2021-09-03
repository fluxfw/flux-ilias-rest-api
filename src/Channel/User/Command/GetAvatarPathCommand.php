<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;

class GetAvatarPathCommand
{

    use UserQuery;

    private UserService $user;


    public static function new(UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->user = $user;

        return $command;
    }


    public function getAvatarPathById(int $id) : ?string
    {
        return $this->getAvatarPath(
            $this->user->getUserById(
                $id
            )
        );
    }


    public function getAvatarPathByImportId(string $import_id) : ?string
    {
        return $this->getAvatarPath(
            $this->user->getUserByImportId(
                $import_id
            )
        );
    }


    private function getAvatarPath(?UserDto $user) : ?string
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

        $profile_image = $ilias_user->getPref("profile_image");
        if (empty($profile_image)) {
            return null;
        }

        $path = getcwd() . "/" . ILIAS_WEB_DIR . "/" . CLIENT_ID . "/usr_images/" . $profile_image;

        if (!file_exists($path)) {
            return null;
        }

        return $path;
    }
}
