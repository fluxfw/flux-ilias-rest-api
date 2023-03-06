<?php

namespace FluxIliasRestApi\Service\UserFavourite\Command;

use FluxIliasRestApi\Adapter\Object\ObjectDto;
use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Adapter\UserFavourite\UserFavouriteDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\User\Port\UserService;
use ilFavouritesDBRepository;

class AddUserFavouriteCommand
{

    private function __construct(
        private readonly UserService $user_service,
        private readonly ObjectService $object_service,
        private readonly ilFavouritesDBRepository $ilias_favourite
    ) {

    }


    public static function new(
        UserService $user_service,
        ObjectService $object_service,
        ilFavouritesDBRepository $ilias_favourite
    ) : static {
        return new static(
            $user_service,
            $object_service,
            $ilias_favourite
        );
    }


    public function addUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function addUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function addUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserById(
                $id
            ),
            $this->object_service->getObjectByRefId(
                $object_ref_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectById(
                $object_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectByImportId(
                $object_import_id,
                false
            )
        );
    }


    public function addUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return $this->addUserFavourite(
            $this->user_service->getUserByImportId(
                $import_id
            ),
            $this->object_service->getObjectByRefId(
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

        if (!$this->ilias_favourite->ifIsFavourite($user->id, $object->ref_id)) {
            $this->ilias_favourite->add($user->id, $object->ref_id);
        }

        return UserFavouriteDto::new(
            $user->id,
            $user->import_id,
            $object->id,
            $object->import_id,
            $object->ref_id
        );
    }
}
