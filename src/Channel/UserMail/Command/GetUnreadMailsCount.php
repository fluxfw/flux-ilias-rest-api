<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserMail\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\UserMail\InternalMailStatus;
use Fluxlabs\FluxIliasRestApi\Channel\UserMail\UserMailQuery;
use ilDBInterface;

class GetUnreadMailsCount
{

    use UserMailQuery;

    private ilDBInterface $database;
    private UserService $user;


    public static function new(ilDBInterface $database, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->user = $user;

        return $command;
    }


    public function getUnreadMailsCountById(int $id) : ?int
    {
        return $this->getUnreadMailsCount(
            $this->user->getUserById(
                $id
            )
        );
    }


    public function getUnreadMailsCountByImportId(string $import_id) : ?int
    {
        return $this->getUnreadMailsCount(
            $this->user->getUserByImportId(
                $import_id
            )
        );
    }


    private function getUnreadMailsCount(?UserDto $user) : ?int
    {
        if ($user === null) {
            return null;
        }

        return $this->database->fetchAssoc($this->database->query($this->getUserMailQuery(
            $user->getId(),
            InternalMailStatus::UNREAD,
            true
        )))["count"];
    }
}