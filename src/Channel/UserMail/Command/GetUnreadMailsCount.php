<?php

namespace FluxIliasRestApi\Channel\UserMail\Command;

use FluxIliasRestApi\Adapter\Api\User\UserDto;
use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\UserMail\LegacyInternalMailStatus;
use FluxIliasRestApi\Channel\UserMail\UserMailQuery;
use ilDBInterface;

class GetUnreadMailsCount
{

    use UserMailQuery;

    private ilDBInterface $ilias_database;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ UserService $user_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->user_service = $user_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        UserService $user_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $user_service
        );
    }


    public function getUnreadMailsCountById(int $id) : ?int
    {
        return $this->getUnreadMailsCount(
            $this->user_service->getUserById(
                $id
            )
        );
    }


    public function getUnreadMailsCountByImportId(string $import_id) : ?int
    {
        return $this->getUnreadMailsCount(
            $this->user_service->getUserByImportId(
                $import_id
            )
        );
    }


    private function getUnreadMailsCount(?UserDto $user) : ?int
    {
        if ($user === null) {
            return null;
        }

        return $this->ilias_database->fetchAssoc($this->ilias_database->query($this->getUserMailQuery(
            $user->getId(),
            LegacyInternalMailStatus::UNREAD()->value,
            true
        )))["count"];
    }
}
