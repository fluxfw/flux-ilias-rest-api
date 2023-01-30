<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasBaseApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\User\UserQuery;
use ilObjUser;

class UpdateAvatarCommand
{

    use UserQuery;

    private function __construct(
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        UserService $user_service
    ) : static {
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
            ilObjUser::_uploadPersonalPicture($file, $user->id);
        } else {
            $ilias_user = $this->getIliasUser(
                $user->id
            );
            if ($ilias_user === null) {
                return null;
            }

            $ilias_user->removeUserPicture();
        }

        return UserIdDto::new(
            $user->id,
            $user->import_id
        );
    }
}
