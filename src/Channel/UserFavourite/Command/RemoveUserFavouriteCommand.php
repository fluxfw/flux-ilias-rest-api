<?php

namespace FluxIliasRestApi\Channel\UserFavourite\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\UserFavourite\UserFavouriteDto;
use FluxIliasRestApi\Channel\Object\Port\ObjectService;
use FluxIliasRestApi\Channel\User\Port\UserService;
use ilFavouritesDBRepository;

class RemoveUserFavouriteCommand
{

    private ilFavouritesDBRepository $ilias_favourite;
    private ObjectService $object_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ilFavouritesDBRepository $ilias_favourite
    ) {
        $this->user_service = $user_service;
        $this->object_service = $object_service;
        $this->ilias_favourite = $ilias_favourite;
    }


    public static function new(
        UserService $user_service,
        ObjectService $object_service,
        ilFavouritesDBRepository $ilias_favourite
    ) : /*static*/ self
    {
        return new static(
            $user_service,
            $object_service,
            $ilias_favourite
        );
    }


    public function removeUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function removeUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function removeUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectByRefId(
                $object_ref_id,
                false
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function removeUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->removeUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectByRefId(
                $object_ref_id,
                false
            )
        );
    }


    private function removeUserFavourite(?UserDto $user, ?ObjectDto $object) : ?UserFavouriteDto
    {
        if ($user === null || $object === null) {
            return null;
        }

        if ($this->ilias_favourite->ifIsFavourite($user->getId(), $object->getRefId())) {
            $this->ilias_favourite->remove($user->getId(), $object->getRefId());
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
