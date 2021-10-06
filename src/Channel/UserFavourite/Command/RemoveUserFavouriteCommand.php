<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Object\ObjectDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserFavourite\FavouriteDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use ilFavouritesDBRepository;

class RemoveUserFavouriteCommand
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


    public function removeUserFavouriteByIdByObjectId(int $id, int $object_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectById(
                $object_id
            )
        );
    }


    public function removeUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectByImportId(
                $object_import_id
            )
        );
    }


    public function removeUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserById(
                $id
            ),
            $this->object->getObjectByRefId(
                $object_ref_id
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectById(
                $object_id
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectByImportId(
                $object_import_id
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?FavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user->getUserByImportId(
                $import_id
            ),
            $this->object->getObjectByRefId(
                $object_ref_id
            )
        );
    }


    private function removeUserFavourite(?UserDto $user, ?ObjectDto $object) : ?FavouriteDto
    {
        if ($user === null || $object === null) {
            return null;
        }

        if ($this->favourite->ifIsFavourite($user->getId(), $object->getRefId())) {
            $this->favourite->remove($user->getId(), $object->getRefId());
        }

        return FavouriteDto::new(
            $user->getId(),
            $user->getImportId(),
            $object->getId(),
            $object->getImportId(),
            $object->getRefId()
        );
    }
}
