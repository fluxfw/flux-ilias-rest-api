<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\User\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\User\UserDto;
use Fluxlabs\FluxIliasRestApi\Channel\User\Port\UserService;
use Fluxlabs\FluxIliasRestApi\Channel\User\UserQuery;
use ilDBInterface;
use LogicException;

class GetCurrentUserCommand
{

    use UserQuery;

    private ilDBInterface $database;
    private UserService $user;


    public static function new(ilDBInterface $database, UserService $user) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;
        $command->user = $user;

        return $command;
    }


    public function getCurrentWebUser(?string $session_id) : ?UserDto
    {
        if (empty($session_id)) {
            return null;
        }

        $user_id = null;
        while (($session = $this->database->fetchAssoc($result ??= $this->database->query($this->getUserSessionQuery(
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

        return $this->user->getUserById(
            $user_id
        );
    }
}
