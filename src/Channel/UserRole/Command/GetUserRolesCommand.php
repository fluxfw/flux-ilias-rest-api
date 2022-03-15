<?php

namespace FluxIliasRestApi\Channel\UserRole\Command;

use FluxIliasRestApi\Channel\UserRole\UserRoleQuery;
use ilDBInterface;

class GetUserRolesCommand
{

    use UserRoleQuery;

    private ilDBInterface $ilias_database;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database
    ) {
        $this->ilias_database = $ilias_database;
    }


    public static function new(
        ilDBInterface $ilias_database
    ) : /*static*/ self
    {
        return new static(
            $ilias_database
        );
    }


    public function getUserRoles(?int $user_id = null, ?string $user_import_id = null, ?int $role_id = null, ?string $role_import_id = null) : array
    {
        return array_map([$this, "mapUserRoleDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getUserRoleQuery(
            $user_id,
            $user_import_id,
            $role_id,
            $role_import_id
        ))));
    }
}
