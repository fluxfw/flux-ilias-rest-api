<?php

namespace FluxIliasRestApi\Adapter\Status;

use JsonSerializable;

class CustomStatus implements Status, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly int $value
    ) {

    }


    public static function factory(int $value) : Status
    {
        return DefaultStatus::tryFrom($value) ?? static::new(
                $value
            );
    }


    private static function new(
        int $value
    ) : static {
        static::$cases ??= [];

        return (static::$cases[$value] ??= new static(
            $value
        ));
    }


    public function jsonSerialize() : int
    {
        return $this->value;
    }
}
