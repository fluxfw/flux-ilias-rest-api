<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDiffDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserIdDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\CreateUserCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\GetCurrentUserCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\GetUserCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\GetUsersCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\UpdateAvatarCommand;
use Fluxlabs\FluxIliasRestApi\Channel\User\Command\UpdateUserCommand;
use ilDBInterface;
use ILIAS\DI\RBACServices;

class UserService
{

    private ilDBInterface $database;
    private ObjectService $object;
    private RBACServices $rbac;


    public static function new(ilDBInterface $database, RBACServices $rbac, ObjectService $object) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->rbac = $rbac;
        $service->object = $object;

        return $service;
    }


    public function createUser(UserDiffDto $diff) : UserIdDto
    {
        return CreateUserCommand::new(
            $this->rbac,
            $this->object
        )
            ->createUser(
                $diff
            );
    }


    public function getCurrentWebUser(?string $session_id) : ?UserDto
    {
        return GetCurrentUserCommand::new(
            $this->database,
            $this
        )
            ->getCurrentWebUser(
                $session_id
            );
    }


    public function getUserById(int $id) : ?UserDto
    {
        return GetUserCommand::new(
            $this->database
        )
            ->getUserById(
                $id
            );
    }


    public function getUserByImportId(string $import_id) : ?UserDto
    {
        return GetUserCommand::new(
            $this->database
        )
            ->getUserByImportId(
                $import_id
            );
    }


    public function getUsers(bool $access_limited_object_ids = false, bool $multi_fields = false, bool $preferences = false, bool $user_defined_fields = false) : array
    {
        return GetUsersCommand::new(
            $this->database
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
            $this->object
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
            $this->object
        )
            ->updateUserByImportId(
                $import_id,
                $diff
            );
    }
}
