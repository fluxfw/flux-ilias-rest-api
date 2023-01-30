<?php

namespace FluxIliasRestApi\Service\UserRole\Command;

use FluxIliasBaseApi\Adapter\UserRole\UserRoleDto;
use FluxIliasRestApi\Service\UserRole\UserRoleQuery;
use ilDBInterface;

class GetUserRolesCommand
{

    use UserRoleQuery;

    private function __construct(
        private readonly ilDBInterface $ilias_database
    ) {

    }


    public static function new(
        ilDBInterface $ilias_database
    ) : static {
        return new static(
            $ilias_database
        );
    }


    /**
     * @return UserRoleDto[]
     */
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
