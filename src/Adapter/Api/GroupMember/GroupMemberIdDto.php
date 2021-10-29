<?php

namespace FluxIliasRestApi\Adapter\Api\GroupMember;

use JsonSerializable;

class GroupMemberIdDto implements JsonSerializable
{

    private ?int $group_id;
    private ?string $group_import_id;
    private ?int $group_ref_id;
    private ?int $user_id;
    private ?string $user_import_id;


    public static function new(?int $group_id = null, ?string $group_import_id = null, ?int $group_ref_id = null, ?int $user_id = null, ?string $user_import_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->group_id = $group_id;
        $dto->group_import_id = $group_import_id;
        $dto->group_ref_id = $group_ref_id;
        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;

        return $dto;
    }


    public function getGroupId() : ?int
    {
        return $this->group_id;
    }


    public function getGroupImportId() : ?string
    {
        return $this->group_import_id;
    }


    public function getGroupRefId() : ?int
    {
        return $this->group_ref_id;
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
