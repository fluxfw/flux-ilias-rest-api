<?php

namespace FluxIliasRestApi\Service\UserMail\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\UserMail\InternalMailStatus;
use FluxIliasRestApi\Service\UserMail\UserMailQuery;
use ilDBInterface;

class GetUnreadMailsCount
{

    use UserMailQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database,
        private readonly UserService $user_service
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database,
        UserService $user_service
    ) : static {
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
            $user->id,
            InternalMailStatus::UNREAD->value,
            true
        )))["count"];
    }
}
