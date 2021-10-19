<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\UserRole\Command;

use Fluxlabs\FluxIliasRestApi\Channel\UserRole\UserRoleQuery;
use ilDBInterface;

class GetUserRolesCommand
{

    use UserRoleQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getUserRoles(?int $user_id = null, ?string $user_import_id = null, ?int $role_id = null, ?string $role_import_id = null) : array
    {
        return array_map([$this, "mapUserRoleDto"], $this->database->fetchAll($this->database->query($this->getUserRoleQuery(
            $user_id,
            $user_import_id,
            $role_id,
            $role_import_id
        ))));
    }
}
