<?php

namespace FluxIliasRestApi\Service\UserFavourite\Port;

use FluxIliasRestApi\Adapter\UserFavourite\UserFavouriteDto;
use FluxIliasRestApi\Service\Object\Port\ObjectService;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\UserFavourite\Command\AddUserFavouriteCommand;
use FluxIliasRestApi\Service\UserFavourite\Command\GetUserFavouritesCommand;
use FluxIliasRestApi\Service\UserFavourite\Command\RemoveUserFavouriteCommand;
use ilDBInterface;
use ilFavouritesDBRepository;

class UserFavouriteService
{

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly UserService $user_service,
        private readonly ObjectService $object_service,
        private readonly ilFavouritesDBRepository $ilias_favourite
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        UserService $user_service,
        ObjectService $object_service,
        ilFavouritesDBRepository $ilias_favourite
    ) : static {
        return new static(
            $ilias_database,
            $user_service,
            $object_service,
            $ilias_favourite
        );
    }


    public function addUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function addUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function addUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function addUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function addUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function addUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return AddUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->addUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }


    /**
     * @return UserFavouriteDto[]
     */
    public function getUserFavourites(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : array
    {
        return GetUserFavouritesCommand::new(
            $this->ilias_database
        )
            ->getUserFavourites(
                $user_id,
                $user_import_id,
                $object_id,
                $object_import_id,
                $object_ref_id
            );
    }


    public function removeUserFavouriteByIdByObjectId(int $id, int $object_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByIdByObjectId(
                $id,
                $object_id
            );
    }


    public function removeUserFavouriteByIdByObjectImportId(int $id, string $object_import_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByIdByObjectImportId(
                $id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByIdByObjectRefId(int $id, int $object_ref_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByIdByObjectRefId(
                $id,
                $object_ref_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectId(string $import_id, int $object_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByImportIdByObjectId(
                $import_id,
                $object_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectImportId(string $import_id, string $object_import_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByImportIdByObjectImportId(
                $import_id,
                $object_import_id
            );
    }


    public function removeUserFavouriteByImportIdByObjectRefId(string $import_id, int $object_ref_id) : ?UserFavouriteDto
    {
        return RemoveUserFavouriteCommand::new(
            $this->user_service,
            $this->object_service,
            $this->ilias_favourite
        )
            ->removeUserFavouriteByImportIdByObjectRefId(
                $import_id,
                $object_ref_id
            );
    }
}
