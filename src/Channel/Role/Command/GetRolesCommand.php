<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Channel\Role\RoleQuery;
use ilDBInterface;

class GetRolesCommand
{

    use RoleQuery;

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


    public function getRoles() : array
    {
        return array_map([$this, "mapRoleDto"], $this->ilias_database->fetchAll($this->ilias_database->query($this->getRoleQuery())));
    }
}
