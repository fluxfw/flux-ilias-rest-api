<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasBaseApi\Adapter\User\UserDiffDto;
use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasBaseApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\User\UserQuery;

class UpdateUserCommand
{

    use UserQuery;

    private function __construct(
        private readonly UserService $user_service,
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        UserService $user_service,
        ObjectService $object_service
    ) : static {
        return new static(
            $user_service,
            $object_service
        );
    }


    public function updateUserById(int $id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user_service->getUserById(
                $id
            ),
            $diff
        );
    }


    public function updateUserByImportId(string $import_id, UserDiffDto $diff) : ?UserIdDto
    {
        return $this->updateUser(
            $this->user_service->getUserByImportId(
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
            $user->id
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
            $user->id,
            $diff->import_id ?? $user->import_id
        );
    }
}
