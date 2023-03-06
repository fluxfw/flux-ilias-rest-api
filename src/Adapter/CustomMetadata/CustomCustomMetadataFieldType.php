<?php

namespace FluxIliasRestApi\Adapter\CustomMetadata;

use JsonSerializable;

class CustomCustomMetadataFieldType implements CustomMetadataFieldType, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly string $value
    ) {

    }


    public static function factory(string $value) : CustomMetadataFieldType
    {
        return DefaultCustomMetadataFieldType::tryFrom($value) ?? static::new(
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
