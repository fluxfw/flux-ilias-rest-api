<?php

namespace FluxIliasRestApi\Channel\Role\Command;

use FluxIliasRestApi\Adapter\Role\RoleDto;
use FluxIliasRestApi\Channel\Role\RoleQuery;
use ilDBInterface;
use LogicException;

class GetRoleCommand
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


    public function getRoleById(int $id) : ?RoleDto
    {
        $role = null;
        while (($role_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getRoleQuery(
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
        while (($role_ = $this->ilias_database->fetchAssoc($result ??= $this->ilias_database->query($this->getRoleQuery(
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
