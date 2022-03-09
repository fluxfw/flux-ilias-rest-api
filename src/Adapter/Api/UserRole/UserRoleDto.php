<?php

namespace FluxIliasRestApi\Adapter\Api\UserRole;

use JsonSerializable;

class UserRoleDto implements JsonSerializable
{

    private ?int $role_id;
    private ?string $role_import_id;
    private ?int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ ?int $role_id,
        /*public readonly*/ ?string $role_import_id
    ) {
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->role_id = $role_id;
        $this->role_import_id = $role_import_id;
    }


    public static function new(
        ?int $user_id = null,
        ?string $user_import_id = null,
        ?int $role_id = null,
        ?string $role_import_id = null
    ) : /*static*/ self
    {
        return new static(
            $user_id,
            $user_import_id,
            $role_id,
            $role_import_id
        );
    }


    public function getRoleId() : ?int
    {
        return $this->role_id;
    }


    public function getRoleImportId() : ?string
    {
        return $this->role_import_id;
    }


    public function getUserId() : ?int
    {
        return $this->user_id;
    }


    public function getUserImportId() : ?string
    {
        return $this->user_import_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
