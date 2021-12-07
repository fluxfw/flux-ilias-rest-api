<?php

namespace FluxIliasRestApi\Adapter\Api\Object;

use JsonSerializable;
use LogicException;

class CustomObjectType implements ObjectType, JsonSerializable
{

    private string $_value;


    public static function factory(string $value) : ObjectType
    {
        return LegacyDefaultObjectType::tryFrom($value) ?? static::new(
                $value
            );
    }


    private static function new(string $value) : /*static*/ self
    {
        $status = new static();

        $status->_value = $value;

        return $status;
    }


    public function __debugInfo() : ?array
    {
        return [
            "value" => $this->value
        ];
    }


    public final function __get(string $key) : string
    {
        switch ($key) {
            case "value":
                return $this->_value;

            default:
                throw new LogicException("Can't get " . $key);
        }
    }


    public final function __set(string $key, /*mixed*/ $value) : void
    {
        throw new LogicException("Can't set");
    }


    public function jsonSerialize() : string
    {
        return $this->value;
    }
}