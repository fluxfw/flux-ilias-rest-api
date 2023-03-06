<?php

namespace FluxIliasRestApi\Service\User\Command;

use FluxIliasRestApi\Adapter\User\UserDto;
use FluxIliasRestApi\Service\User\Port\UserService;
use FluxIliasRestApi\Service\User\UserQuery;
use ilDBInterface;
use LogicException;

class GetCurrentUserCommand
{

    use UserQuery;

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


    public function getCurrentWebUser(?string $session_id) : ?UserDto
    {
        if (empty($session_id)) {
            return null;
        }

        $user_id = null;
        while (($session = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getUserSessionQuery(
                $session_id
            )))) !== null) {
            if ($user_id !== null) {
                throw new LogicException("Multiple sessions found");
            }
            $user_id = $session["user_id"];
        }

        if (empty($user_id) || intval($user_id) === intval(ANONYMOUS_USER_ID)) {
            return null;
        }

        return $this->user_service->getUserById(
            $user_id
        );
    }
}
