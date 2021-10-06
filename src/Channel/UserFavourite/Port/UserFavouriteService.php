<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Port;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\UserFavourite\FavouriteDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\Port\ObjectService;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Command\AddUserFavouriteCommand;
use Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Command\GetUserFavouritesCommand;
use Fluxlabs\FluxIliasRestApi\Channel\UserFavourite\Command\RemoveUserFavouriteCommand;
use ilDBInterface;
use ilFavouritesDBRepository;

class UserFavouriteService
{

    private ilDBInterface $database;
    private ilFavouritesDBRepository $favourite;
    private ObjectService $object;
    private UserService $user;


    public static function new(ilDBInterface $database, UserService $user, ObjectService $object, ilFavouritesDBRepository $favourite) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->user = $user;
        $service->object = $object;
        $service->favourite = $favourite;

        return $service;
    }


    public function addUserFavouriteByIdByObjectId(int $id, int $object_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function addUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function addUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function addUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function addUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function addUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?FavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->addUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }


    public function getUserFavourites(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : array
    {
        return GetUserFavouritesCommand::new(
            $this->database
        )
            ->getUserFavourites(
                $user_id,
                $user_import_id,
                $object_id,
                $object_import_id,
                $object_ref_id
            );
    }


    public function removeUserFavouriteByIdByObjectId(int $id, int $object_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function removeUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?FavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user,
            $this->object,
            $this->favourite
        )
            ->removeUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }
}
