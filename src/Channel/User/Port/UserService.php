<?php

namespace FluxIliasRestApi\Channel\User\Port;

use FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\User\Command\CreateUserCommand;
use FluxIliasRestApi\Channel\User\Command\GetCurrentUserCommand;
use FluxIliasRestApi\Channel\User\Command\GetUserCommand;
use FluxIliasRestApi\Channel\User\Command\GetUsersCommand;
use FluxIliasRestApi\Channel\User\Command\UpdateAvatarCommand;
use FluxIliasRestApi\Channel\User\Command\UpdateUserCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class UserService
{

    private ilDBInterface $ilias_database;
    private RBACServices $ilias_rbac;
    private ObjectService $object_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ RBACServices $ilias_rbac,
        /*private readonly*/ ObjectService $object_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->ilias_rbac = $ilias_rbac;
        $this->object_service = $object_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        RBACServices $ilias_rbac,
        ObjectService $object_service
    ) : /*static*/ self
    {
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


    public function getUsers(bool $access_limited_object_ids = false, bool $multi_fields = false, bool $preferences = false, bool $user_defined_fields = false) : array
    {
        return GetUsersCommand::new(
            $this->ilias_database
        )
            ->getUsers(
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
