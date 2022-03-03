<?php

namespace FluxIliasRestApi\Channel\UserFavourite\Command;

use FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Adapter\Api\UserFavourite\UserFavouriteDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use ilFavouritesDBRepository;

class AddUserFavouriteCommand
{

    private ilFavouritesDBRepository $favourite;
    private ObjectService $object;
    private UserService $user;


    public static function new(UserService $user, ObjectService $object, ilFavouritesDBRepository $favourite) : /*static*/ self
    {
        $command = new static();

        $command->user = $user;
        $command->object = $object;
        $command->favourite = $favourite;

        return $command;
    }


    public function addUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function addUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function addUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectByRefId(
                $object_ref_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectByRefId(
                $object_ref_id,
                false
            )
        );
    }


    private function addUserFavourite(?UserDto $user, ?ObjectDto $object) : ?UserFavouriteDto
    {
        if ($user === null || $object === null) {
            return null;
        }

        if (!$this->favourite->ifIsFavourite($user->getId(), $object->getRefId())) {
            $this->favourite->add($user->getId(), $object->getRefId());
        }

        return UserFavouriteDto::new(
            $user->getId(),
            $user->getImportId(),
            $object->getId(),
            $object->getImportId(),
            $object->getRefId()
        );
    }
}
