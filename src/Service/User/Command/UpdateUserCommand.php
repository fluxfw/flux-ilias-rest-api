<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasRestApi\Adapter\User\UserDiffDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Service\Constants\Port\ConstantsService;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\User\UserQuery;

class UpdateUserCommand
{

    use UserQuery;

    private function __construct(
        private readonly ConstantsService $constants_service,
        private readonly ObjectService $object_service,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        ConstantsService $constants_service,
        ObjectService $object_service,
        UserService $user_service
    ) : static {
        return new static(
            $constants_service,
            $object_service,
            $user_service
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
        $constants = $this->constants_service->getConstants();

        if ($user === null || $user->id === $constants->root_user_id || $user->id === $constants->rest_user_user_id) {
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
