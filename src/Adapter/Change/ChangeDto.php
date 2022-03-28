<?php

namespace FluxIliasRestApi\Adapter\Change;

use JsonSerializable;

class ChangeDto implements JsonSerializable
{

    private object $data;
    private int $id;
    private float $time;
    private LegacyChangeType $type;
    private int $user_id;
    private ?string $user_import_id;


    private function __construct(
        /*public readonly*/ int $id,
        /*public readonly*/ LegacyChangeType $type,
        /*public readonly*/ float $time,
        /*public readonly*/ int $user_id,
        /*public readonly*/ ?string $user_import_id,
        /*public readonly*/ object $data
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->time = $time;
        $this->user_id = $user_id;
        $this->user_import_id = $user_import_id;
        $this->data = $data;
    }


    public static function new(
        int $id,
        LegacyChangeType $type,
        float $time,
        int $user_id,
        ?string $user_import_id,
        object $data
    ) : /*static*/ self
    {
        return new static(
            $id,
            $type,
            $time,
            $user_id,
            $user_import_id,
            $data
        );
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
