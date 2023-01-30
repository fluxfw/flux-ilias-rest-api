<?php

namespace FluxIliasRestApi\Service\User\Port;

use FluxIliasBaseApi\Adapter\User\UserDiffDto;
use FluxIliasBaseApi\Adapter\User\UserDto;
use FluxIliasBaseApi\Adapter\User\UserIdDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\User\Command\CreateUserCommand;
use FluxIliasRestApi\Service\User\Command\GetCurrentUserCommand;
use FluxIliasRestApi\Service\User\Command\GetUserCommand;
use FluxIliasRestApi\Service\User\Command\GetUsersCommand;
use FluxIliasRestApi\Service\User\Command\UpdateAvatarCommand;
use FluxIliasRestApi\Service\User\Command\UpdateUserCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class UserService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly RBACServices $ilias_rbac,
        private readonly ObjectService $object_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        RBACServices $ilias_rbac,
        ObjectService $object_service
    ) : static {
        return new static(
            $ilias_database,
            $ilias_rbac,
            $object_service
        );
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        return CreateUserCommand::new(
            $this->ilias_rbac,
            $this->object_service
        )
            ->createUser(
                $diff
            );
    }


    public function getCurrentWebUser(?string $session_id) : ?UserDto
    {
        return GetCurrentUserCommand::new(
            $this->ilias_database,
            $this
        )
            ->getCurrentWebUser(
                $session_id
            );
    }


    public function getUserById(int $id) : ?UserDto
    {
        return GetUserCommand::new(
            $this->ilias_database
        )
            ->getUserById(
                $id
            );
    }


    public function getUserByImportId(string $import_id) : ?UserDto
    {
        return GetUserCommand::new(
            $this->ilias_database
        )
            ->getUserByImportId(
                $import_id
            );
    }


    /**
     * @return UserDto[]
     */
    public function getUsers(
        ?string $external_account = null,
        ?string $login = null,
        ?string $email = null,
        ?string $matriculation_number = null,
        bool $access_limited_object_ids = false,
        bool $multi_fields = false,
        bool $preferences = false,
        bool $user_defined_fields = false
    ) : array {
        return GetUsersCommand::new(
            $this->ilias_database
        )
            ->getUsers(
                $external_account,
                $login,
                $email,
                $matriculation_number,
                $access_limited_object_ids,
                $multi_fields,
                $preferences,
                $user_defined_fields
            );
    }


    public function updateAvatarById(int $id, ?string $file) : ?UserIdDto
    {
        return UpdateAvatarCommand::new(
            $this
        )
            ->updateAvatarById(
                $id,
                $file
            );
    }


    public function updateAvatarByImportId(string $import_id, ?string $file) : ?UserIdDto
    {
        return UpdateAvatarCommand::new(
            $this
        )
            ->updateAvatarByImportId(
                $import_id,
                $file
            );
    }


    public function updateUserById(int $id, UserDiffDto $diff) : ?UserIdDto
    {
        return UpdateUserCommand::new(
            $this,
            $this->object_service
        )
            ->updateUserById(
                $id,
                $diff
            );
    }


    public function updateUserByImportId(string $import_id, UserDiffDto $diff) : ?UserIdDto
    {
        return UpdateUserCommand::new(
            $this,
            $this->object_service
        )
            ->updateUserByImportId(
                $import_id,
                $diff
            );
    }
}
