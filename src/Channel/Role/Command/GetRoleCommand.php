<?php

namespace Fluxlabs\FluxIliasRestApi\Channel\Role\Command;

use Fluxlabs\FluxIliasRestApi\Adapter\Api\Role\RoleDto;
use Fluxlabs\FluxIliasRestApi\Channel\Object\ObjectQuery;
use Fluxlabs\FluxIliasRestApi\Channel\Role\RoleQuery;
use ilDBInterface;
use LogicException;

class GetRoleCommand
{

    use RoleQuery;
    use ObjectQuery;

    private ilDBInterface $database;


    public static function new(ilDBInterface $database) : /*static*/ self
    {
        $command = new static();

        $command->database = $database;

        return $command;
    }


    public function getRoleById(int $id) : ?RoleDto
    {
        $role = null;
        while (($role_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getRoleQuery(
                $id
            )))) !== null) {
            if ($role !== null) {
                throw new LogicException("Multiple roles found with the id " . $id);
            }
            $role = $this->mapRoleDto(
                $role_
            );
        }

        return $role;
    }


    public function getRoleByImportId(string $import_id) : ?RoleDto
    {
        $role = null;
        while (($role_ = $this->database->fetchAssoc($result ??= $this->database->query($this->getRoleQuery(
                null,
                $import_id
            )))) !== null) {
            if ($role !== null) {
                throw new LogicException("Multiple roles found with the import id " . $import_id);
            }
            $role = $this->mapRoleDto(
                $role_
            );
        }

        return $role;
    }
}
