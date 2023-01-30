<?php

namespace FluxIliasRestApi\Adapter\CronConfig;

use JsonSerializable;

class CustomScheduleTypeCronConfig implements ScheduleTypeCronConfig, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly string $value
    ) {

    }


    public static function factory(string $value) : ScheduleTypeCronConfig
    {
        return DefaultScheduleTypeCronConfig::tryFrom($value) ?? static::new(
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
