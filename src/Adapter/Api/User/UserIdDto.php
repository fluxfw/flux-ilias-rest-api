<?php

namespace Fluxlabs\FluxIliasRestApi\Adapter\Api\User;

use JsonSerializable;

class UserIdDto implements JsonSerializable
{

    private ?int $id;
    private ?string $import_id;


    public static function new(?int $id = null, ?string $import_id = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->import_id = $import_id;

        return $dto;
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
