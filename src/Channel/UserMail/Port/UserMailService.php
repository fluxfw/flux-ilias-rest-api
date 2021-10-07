<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserMail\Port;

use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\UserMail\Command\GetUnreadMailsCount;
use ilDBInterface;

class UserMailService
{

    private ilDBInterface $database;
    private UserService $user;


    public static function new(ilDBInterface $database, UserService $user) : /*static*/ self
    {
        $service = new static();

        $service->database = $database;
        $service->user = $user;

        return $service;
    }


    public function getUnreadMailsCountById(int $id) : ?int
    {
        return GetUnreadMailsCount::new(
            $this->database,
            $this->user
        )
            ->getUnreadMailsCountById(
                $id
            );
    }


    public function getUnreadMailsCountByImportId(string $import_id) : ?int
    {
        return GetUnreadMailsCount::new(
            $this->database,
            $this->user
        )
            ->getUnreadMailsCountByImportId(
                $import_id
            );
    }
}
