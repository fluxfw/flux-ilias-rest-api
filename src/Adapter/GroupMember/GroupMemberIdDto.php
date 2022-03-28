<?php

namespace FluxIliasRestApi\Adapter\GroupMember;

use JsonSerializable;

class GroupMemberIdDto implements JsonSerializable
{

    private ?int $group_id;
    private ?string $group_import_id;
    private ?int $group_ref_id;
    private ?int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ ?int $group_id,
        /*public readonly*/ ?string $group_import_id,
        /*public readonly*/ ?int $group_ref_id,
        /*public readonly*/ ?int $user_id,
        /*public readonly*/ ?string $user_import_id
    ) {
        $this->group_id = $group_id;
        $this->group_import_id = $group_import_id;
        $this->group_ref_id = $group_ref_id;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
    }


    public static function new(
        ?int $group_id = null,
        ?string $group_import_id = null,
        ?int $group_ref_id = null,
        ?int $user_id = null,
        ?string $user_import_id = null
    ) : /*static*/ self
    {
        return new static(
            $group_id,
            $group_import_id,
            $group_ref_id,
            $user_id,
            $user_import_id
        );
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
