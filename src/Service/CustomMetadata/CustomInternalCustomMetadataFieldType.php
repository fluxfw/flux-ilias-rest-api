<?php

namespace FluxIliasRestApi\Service\CustomMetadata;

use JsonSerializable;

class CustomInternalCustomMetadataFieldType implements InternalCustomMetadataFieldType, JsonSerializable
{

    /**
     * @var static[]
     */
    private static array $cases;


    private function __construct(
        public readonly int $value
    ) {

    }


    public static function factory(int $value) : InternalCustomMetadataFieldType
    {
        return DefaultInternalCustomMetadataFieldType::tryFrom($value) ?? static::new(
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
