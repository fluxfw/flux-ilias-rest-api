<?php

namespace FluxIliasRestApi\Service\CronConfig;

use JsonSerializable;

class CustomInternalScheduleTypeCronConfig implements InternalScheduleTypeCronConfig, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly int $value
    ) {

    }


    public static function factory(int $value) : InternalScheduleTypeCronConfig
    {
        return DefaultInternalScheduleTypeCronConfig::tryFrom($value) ?? static::new(
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
