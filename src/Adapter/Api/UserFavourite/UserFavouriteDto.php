<?php

namespace FluxIliasRestApi\Adapter\Api\UserFavourite;

use JsonSerializable;

class UserFavouriteDto implements JsonSerializable
{

    private ?int $object_id;
    private ?string $object_import_id;
    private ?int $object_ref_id;
    private ?int $user_id;
    private ?string $user_import_id;


    public static function new(?int $user_id = null, ?string $user_import_id = null, ?int $object_id = null, ?string $object_import_id = null, ?int $object_ref_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;
        $dto->object_id = $object_id;
        $dto->object_import_id = $object_import_id;
        $dto->object_ref_id = $object_ref_id;

        return $dto;
    }


    public function getObjectId() : ?int
    {
        return $this->object_id;
    }


    public function getObjectImportId() : ?string
    {
        return $this->object_import_id;
    }


    public function getObjectRefId() : ?int
    {
        return $this->object_ref_id;
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
