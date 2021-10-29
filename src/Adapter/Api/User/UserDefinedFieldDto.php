<?php

namespace FluxIliasRestApi\Adapter\Api\User;

use JsonSerializable;

class UserDefinedFieldDto implements JsonSerializable
{

    private ?int $id;
    private ?string $name;
    private ?string $value;


    public static function new(?int $id = null, ?string $name = null, ?string $value = null) : /*static*/ self
    {
        $dto = new static();

        $dto->id = $id;
        $dto->name = $name;
        $dto->value = $value;

        return $dto;
    }


    public function getId() : ?int
    {
        return $this->id;
    }


    public function getName() : ?string
    {
        return $this->name;
    }


    public function getValue() : ?string
    {
        return $this->value;
    }


    public function jsonSerialize() : array
    {
        return get_object_vars($this);
    }
}
