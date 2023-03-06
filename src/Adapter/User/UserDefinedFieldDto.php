<?php

namespace FluxIliasRestApi\Adapter\User;

class UserDefinedFieldDto
{

    private function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $value
    ) {

    }


    public static function new(
        ?int $id = null,
        ?string $name = null,
        ?string $value = null
    ) : static {
        return new static(
            $id,
            $name,
            $value
        );
    }


    public static function newFromObject(
        object $user_definied_field
    ) : static {
        return static::new(
            $user_definied_field->id ?? null,
            $user_definied_field->name ?? null,
            $user_definied_field->value ?? null
        );
    }
}
