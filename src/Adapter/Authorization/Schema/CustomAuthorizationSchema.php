<?php

namespace FluxIliasRestApi\Adapter\Authorization\Schema;

use JsonSerializable;

class CustomAuthorizationSchema implements AuthorizationSchema, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly string $value
    ) {

    }


    public static function factory(string $value) : AuthorizationSchema
    {
        return DefaultAuthorizationSchema::tryFrom($value) ?? static::new(
                $value
            );
    }


    private static function new(
        string $value
    ) : static {
        static::$cases ??= [];

        return (static::$cases[$value] ??= new static(
            $value
        ));
    }


    public function jsonSerialize() : string
    {
        return $this->value;
    }
}
