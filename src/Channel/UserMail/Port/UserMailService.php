<?php

namespace FluxIliasRestApi\Channel\UserMail\Port;

use FluxIliasRestApi\Channel\User\Port\UserService;
use FluxIliasRestApi\Channel\UserMail\Command\GetUnreadMailsCount;
use ilDBInterface;

class UserMailService
{

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
        return GetUnreadMailsCount::new(
            $this->ilias_database,
            $this->user_service
        )
            ->getUnreadMailsCountById(
                $id
            );
    }


    public function getUnreadMailsCountByImportId(string $import_id) : ?int
    {
        return GetUnreadMailsCount::new(
            $this->ilias_database,
            $this->user_service
        )
            ->getUnreadMailsCountByImportId(
                $import_id
            );
    }
}
