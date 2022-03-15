<?php

namespace FluxIliasRestApi\Adapter\Api\User;

use JsonSerializable;

class UserDefinedFieldDto implements JsonSerializable
{

    private ?int $id;
    private ?string $name;
    private ?string $value;


    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $name,
        /*public readonly*/ ?string $value
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }


    public static function new(
        ?int $id = null,
        ?string $name = null,
        ?string $value = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $name,
            $value
        );
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
