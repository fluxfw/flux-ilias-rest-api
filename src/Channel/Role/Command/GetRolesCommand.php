<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Channel\Role\RoleQuery;
use ilDBInterface;

class GetRolesCommand
{

    use RoleQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getRoles() : array
    {
        return array_map([$this, "mapRoleDto"], $this->database->fetchAll($this->database->query($this->getRoleQuery())));
    }
}
