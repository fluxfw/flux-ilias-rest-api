<?php

namespace FluxIliasRestApi\Service\Role\Command;

use FluxIliasRestApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Service\Role\RoleQuery;
use ilDBInterface;

class GetRolesCommand
{

    use RoleQuery;

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
     * @return RoleDto[]
     */
    public function getRoles() : array
    {
        return array_map([$this, "mapRoleDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getRoleQuery())));
    }
}
