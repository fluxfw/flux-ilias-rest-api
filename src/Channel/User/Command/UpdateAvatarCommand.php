<?php

namespace FluxIliasRestApi\Channel\User\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\User\UserQuery;
use ilObjUser;

class UpdateAvatarCommand
{

    use UserQuery;

    private UserService $user_service;


    private function __construct(
        /*private readonly*/ UserService $user_service
    ) {
        $this->user_service = $user_service;
    }


    public static function new(
        UserService $user_service
    ) : /*static*/ self
    {
        return new static(
            $user_service
        );
    }


    public function updateAvatarById(int $id, ?string $file) : ?UserIdDto
    {
        return $this->updateAvatar(
            $this->user_service->getUserById(
                $id
            ),
            $file
        );
    }


    public function updateAvatarByImportId(string $import_id, ?string $file) : ?UserIdDto
    {
        return $this->updateAvatar(
            $this->user_service->getUserByImportId(
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
