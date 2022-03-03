<?php

namespace FluxIliasRestApi\Adapter\Api\Change;

use JsonSerializable;

class ChangeDto implements JsonSerializable
{

    private object $data;
    private int $id;
    private float $time;
    private LegacyChangeType $type;
    private int $user_id;
    private ?string $user_import_id;


    public static function new(int $id, LegacyChangeType $type, float $time, int $user_id, ?string $user_import_id, object $data) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->type = $type;
        $dto->time = $time;
        $dto->user_id = $user_id;
        $dto->user_import_id = $user_import_id;
        $dto->data = $data;

        return $dto;
    }


    public function getData() : object
    {
        return $this->data;
    }


    public function getId() : int
    {
        return $this->id;
    }


    public function getTime() : float
    {
        return $this->time;
    }


    public function getType() : LegacyChangeType
    {
        return $this->type;
    }


    public function getUserId() : int
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
