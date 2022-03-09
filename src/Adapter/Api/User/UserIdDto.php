<?php

namespace FluxIliasRestApi\Adapter\Api\User;

use JsonSerializable;

class UserIdDto implements JsonSerializable
{

    private ?int $id;
    private ?string $import_id;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
    }


    public static function new(
        ?int $id = null,
        ?string $import_id = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id
        );
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getImportId() : ?string
    {
        return $this->import_id;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
